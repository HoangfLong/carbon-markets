<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CreditSerial;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Repositories\Eloquent\CartItemRepository;
use App\Services\SerialCodeGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CartController extends Controller
{
    protected $cartItemRepo;

    public function __construct(CartItemRepository $cartItemRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
    }

    // Add to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'credit_id' => 'required|exists:credits,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Check if user has cart, if not create one
        $cart = $user->cart;
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }
        
        // Add item to cart
        $this->cartItemRepo->addToCart($request->credit_id, $request->quantity);

        // Update quantity item
        $cartItemsCount = $cart->cartItems ? $cart->cartItems->quantity->count() : 0;

        return response()->json([
            'cartItemsCount' => $cartItemsCount,
            'message' => 'Product added to your cart!',
        ]);
    }

    //Update cart
    public function update(Request $request, $cartItemId)
    {
        // Validate the new quantity
        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure quantity is a positive integer
        ]);

        // Get the new quantity
        $newQuantity = $request->input('quantity');
        
        // Call the repository method to update the cart item
        $response = $this->cartItemRepo->updateCartItem($cartItemId, $newQuantity);

        // Return a JSON response for AJAX request
        if ($response['success']) {
            return response()->json([
                'success' => true,
                'message' => 'Cart item updated successfully',
                'price' => $response['price'],  // Return updated price for calculation
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
            ]);
        }
    }

    //Clear cart
    public function clearCart($cartItemId)
    {
        try {
            $response = $this->cartItemRepo->clearCartItems($cartItemId); // Gọi repository để xóa mục giỏ hàng
    
            if ($response['success']) {
                return redirect()->route('cart.index')->with('success', $response['message']);
            }
    
            return redirect()->route('cart.index')->withErrors(['message' => $response['message']]);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->withErrors(['message' => 'An error occurred while removing the item from the cart']);
        }
    }

    // View cart
    public function showCart()
    {
        $cartItems = $this->cartItemRepo->getCartItems();

        return view('cart.index', compact('cartItems'));
    }

    // Checkout cart
    public function checkout(Request $request)
    {
        // Get all cart item
        $cartItems = $this->cartItemRepo->getCartItems();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->withErrors(['message' => 'Giỏ hàng trống.']);
        }

        // Total cart item
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Create order
        $order = Order::create([
            'user_ID' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'country' => Auth::user()->country,
            'company' => Auth::user()->company,
            'address' => Auth::user()->address,
        ]);

        // Create order item
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_ID' => $order->id,
                'carbon_credit_ID' => $cartItem->credit->id,
                'quantity' => $cartItem->quantity,
                'price_per_ton' => $cartItem->price,
                'total_price' => $cartItem->quantity * $cartItem->price,
            ]);
        }

        // API
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => collect($cartItems)->map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item->credit->project->name ?? 'Không xác định',
                        ],
                        'unit_amount' => $item->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
            })->toArray(),
            'mode' => 'payment',
            'success_url' => route('cart.success', ['orderId' => $order->id]),
            'cancel_url' => route('cart.cancel'),
        ]);

        // Redirect to checkout
        return redirect($session->url);
    }

    // Success payment
    public function success($orderId)
    {
        $order = Order::with('orderItems.credit')->findOrFail($orderId);

        //Check transaction
        $transaction = Transaction::where('order_ID', $orderId)->latest()->first();

        //Create transaction record
        if(!$transaction) {
            $transaction = Transaction::create([
                'order_ID' => $order->id,
                'amount' => $order->total_amount,
                'payment_method' => 'credit_card',
                'status' => 'success',
                'transaction_date' => now(),
            ]);
        }

        // Check status transaction
        if (!$transaction || $transaction->status !== 'success') {
            return response()->json(['error' => 'Invalid transaction'], 400);
        }
    
        // Check if credit has created before
        if (CreditSerial::where('transaction_ID', $transaction->id)->exists()) {
            return response()->json(['message' => 'Invalid transaction'], 200);
        }

        // Check if no order item
        if ($order->orderItems->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'No order items found for this order.']);
        }

        // Check orderItem if don't have credit
        foreach ($order->orderItems as $orderItem) {
            if (!$orderItem->credit) {
                return redirect()->back()->withErrors(['message' => 'No credit found for the order item.']);
            }
        }

        // Update order
        $order->status = 'completed';
        $order->save();

        // Save serial code
        foreach ($order->orderItems as $orderItem) {
            $credit = $orderItem->credit;

            // Check if enough quantity_available
            if ($credit->quantity_available < $orderItem->quantity) {
                return redirect()->back()->withErrors(['message' => 'Không đủ tín chỉ để thanh toán.']);
            }

            // Decrease available quantity
            $credit->quantity_available -= $orderItem->quantity;
            $credit->save();

            $serialCode = SerialCodeGenerator::generate(); // Sinh mã serial duy nhất

            CreditSerial::create([
                'transaction_ID' => $transaction->id,  // Gắn mã giao dịch vào
                'carbon_credit_ID' => $credit->id,     // Gắn ID tín chỉ vào
                'order_item_ID' => $orderItem->id,     // Gắn order item vào
                'quantity' => $orderItem->quantity,    // Số lượng tín chỉ của dự án này
                'serial_code' => $serialCode,          // Mã serial duy nhất
            ]);
        }
        
        // Delete all cart item
        CartItem::where('cart_id', Auth::user()->cart->id)->delete();

        // Return view cart success
        return view('payments.success', ['order' => $order]);
    }

    // Cancel payment
    public function cancel()
    {
        return view('payments.cancel');
    }
}