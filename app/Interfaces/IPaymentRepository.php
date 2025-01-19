<?php

namespace App\Interfaces;

interface IPaymentRepository
{
    public function createOrder($user, $amount, $pricePerTon);
    public function processPayment($order, $amount, $pricePerTon);
}
