@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <div class="card p-5 shadow-lg">
        <h2 class="text-success"><i class="bi bi-check-circle-fill"></i> Thanh toán thành công!</h2>
        <p class="mt-3">Cảm ơn bạn đã mua hàng. Giao dịch của bạn đã hoàn tất.</p>
        <p><strong>Mã đơn hàng:</strong> <span class="badge bg-primary">#{{ $order->id }}</span></p>

        <div class="mt-4">
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-eye"></i> Xem đơn hàng
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="bi bi-house-door"></i> Về trang chủ
            </a>
        </div>
    </div>
</div>
@endsection
