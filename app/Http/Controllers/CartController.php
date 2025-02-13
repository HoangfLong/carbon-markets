<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Repositories\Eloquent\CartItemRepository;
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

    public function addToCart(Request $request)
    {
        $request->validate([
            'credit_id' => 'required|exists:credits,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartItemRepo->addToCart($request->credit_id, $request->quantity);

        return redirect()->back()->with('success', 'add to your cart successful');
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

        // create order item
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

        // Update order
        $order->status = 'completed';
        $order->save();

        // Create transaction
        Transaction::create([
            'order_ID' => $order->id,
            'amount' => $order->total_amount,
            'payment_method' => 'credit_card',
            'status' => 'success',
            'transaction_date' => now(),
        ]);

        // Save serial code
        foreach ($order->orderItems as $orderItem) {
            $credit = $orderItem->credit;
            // Update credit available
            if ($credit->quantity_available < $orderItem->quantity) {
                return redirect()->back()->withErrors(['message' => 'Không đủ tín chỉ để thanh toán.']);
            }

            $credit->quantity_available -= $orderItem->quantity;
            $credit->save();
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