<?php

namespace App\Repositories;

use App\Interfaces\IPaymentRepository;
use App\Models\Order;
use App\Models\Transaction;
use Stripe\PaymentIntent;
use Stripe\Stripe;

//use Your Model

/**
 * Class PaymentRepository.
 */
class PaymentRepository implements IPaymentRepository
{
    public function createOrder($user, $amount, $pricePerTon)
    {
        $totalAmount = $amount * $pricePerTon;

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_ID' => $user->id,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return $order;
    }

    public function processPayment($order, $amount, $pricePerTon)
    {
        $totalAmount = $amount * $pricePerTon;

        // Khởi tạo Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Tạo Payment Intent
        $paymentIntent = PaymentIntent::create([
            'amount' => $totalAmount * 100, // Stripe yêu cầu số tiền tính bằng cents
            'currency' => 'usd',
        ]);

        // Tạo giao dịch
        $transaction = Transaction::create([
            'order_ID' => $order->id,
            'amount' => $totalAmount,
            'payment_method' => 'credit_card',
            'status' => 'pending',
            'transaction_date' => now(),
        ]);

        return $paymentIntent->client_secret;
    }
}
