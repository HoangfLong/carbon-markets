
@extends('layouts.app')
@section('content')
    <h2>Payment Successful!</h2>
    <p>Thank you for your purchase. Your transaction has been completed.</p>
    <p>Order ID: {{ $order->id }}</p>
@endsection
