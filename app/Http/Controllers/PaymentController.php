<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show($carbonProjectId)
    {
        $carbonProject = Project::with('credits')->findOrFail($carbonProjectId);
        return view('payment.show', compact('carbonProject'));
    }

    public function checkout(Request $request, $carbonProjectId)
    {
        // Get selected carbon project
        $carbonProject = Project::with('credits')->findOrFail($carbonProjectId);
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
        // Kiểm tra và cập nhật order nếu cần
        $order = Order::findOrFail($orderId);
        $order->status = 'completed';
        $order->save();

        // Create transaction record
        Transaction::create([
            'order_ID' => $order->id,
            'amount' => $order->total_amount,
            'payment_method' => 'credit_card',
            'status' => 'success',
            'transaction_date' => now(),
        ]);

        return view('payment.success', ['order' => $order]);
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
