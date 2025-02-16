<?php

namespace App\Http\Controllers;

use App\Models\CreditSerial;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Project;
use App\Models\Transaction;
use App\Services\SerialCodeGenerator;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show($projectId)
    {
        $carbonProject = Project::with('credits')->findOrFail($projectId);
        return view('project.show', compact('carbonProject'));
    }

    public function checkout(Request $request, $projectId)
    {
        // Get selected carbon project
        $carbonProject = Project::with('credits')->findOrFail($projectId);
        $amount = $request->input('amount');
        $totalAmount = $amount * $carbonProject->credits->first()->price_per_ton;

        // Create order in DB
        $order = Order::create([
            'user_ID' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'country' => Auth::user()->country,
            'company' => Auth::user()->company,
            'address' => Auth::user()->address,
        ]);

        // Create order items
        OrderItem::create([
            'order_ID' => $order->id,
            'carbon_credit_ID' => $carbonProject->credits->first()->id,
            'quantity' => $amount,
            'price_per_ton' => $carbonProject->credits->first()->price_per_ton,
            'total_price' => $totalAmount,
        ]);

        // Create Stripe checkout session
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $carbonProject->name,
                        ],
                        'unit_amount' => $totalAmount * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['orderId' => $order->id]),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success($orderId)
    {
        //Kiểm tra và cập nhật order nếu cần
        $order = Order::with('orderItems.credit')->findOrFail($orderId);

        //Check transaction
        $transaction = Transaction::where('order_ID', $orderId)->latest()->first();

        // Create transaction record
        if(!$transaction) {
            $transaction = Transaction::create([
                'order_ID' => $order->id,
                'amount' => $order->total_amount,
                'payment_method' => 'credit_card',
                'status' => 'success',
                'transaction_date' => now(),
            ]);
        }

        //Kiểm tra trạng thái transaction
        if (!$transaction || $transaction->status !== 'success') {
            return response()->json(['error' => 'Invalid transaction'], 400);
        }
    
        //Kiểm tra nếu credits đã được tạo trước đó
        if (CreditSerial::where('transaction_ID', $transaction->id)->exists()) {
            return response()->json(['message' => 'Invalid transaction'], 200);
        }

        //Kiểm tra nếu không có order items
        if ($order->orderItems->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'No order items found for this order.']);
        }

        //Kiểm tra nếu mỗi orderItem không có tín chỉ (credit)
        foreach ($order->orderItems as $orderItem) {
            if (!$orderItem->credit) {
                return redirect()->back()->withErrors(['message' => 'No credit found for the order item.']);
            }
        }

        //Cập nhật trạng thái order
        $order->status = 'completed';
        $order->save();

        //Sinh một mã serial code duy nhất cho tất cả các tín chỉ trong đơn hàng
        $serialCode = SerialCodeGenerator::generate();

        //Lưu thông tin mã serial vào bảng credit_serials cho tất cả tín chỉ đã mua
        foreach ($order->orderItems as $orderItem) {
            $credit = $orderItem->credit; // Lấy tín chỉ (credit) từ order item
            //Lưu thông tin mã serial vào bảng credit_serials

            //Deduct the quantity from Quantity_available
            if ($credit->quantity_available < $orderItem->quantity) {
                return redirect()->back()->withErrors(['message' => 'Not enough credits available.']);
            }

            $credit->quantity_available -= $orderItem->quantity;
            $credit->save();

            CreditSerial::create([
                'transaction_ID' => $order->transaction->id ?? null,
                'order_item_ID' => $orderItem->id,
                'carbon_credit_ID' => $credit->id,
                'quantity' => $orderItem->quantity,
                'serial_code' => $serialCode, //Mã serial duy nhất cho tất cả tín chỉ
            ]);
        }
        return view('payments.success', ['order' => $order]);
    }

    public function cancel()
    {
        return view('payments.cancel');
    }
}
