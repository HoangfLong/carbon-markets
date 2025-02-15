@php
    $hideWelcomeSection = true;
    $hideFooterSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5 mb-5">
    <a href="{{ url()->previous() }}" >
        <button class="btn btn-outline-secondary position-absolute start-3 ms-3 mt-3">&larr; Back</button>
    </a>    
    <h2 class="text-center mb-4">Your Order</h2>
    @if($orders->isEmpty())
        <div class="alert alert-warning text-center">Your order empty.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order id</th>
                        <th>Date</th>
                        <th>Total amount</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @if($order->status == 'completed')
                                <span class="badge bg-success">Success</span>
                            @elseif($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Fail</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}">
                                <button type="button" class="btn btn-outline-secondary" >View</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
