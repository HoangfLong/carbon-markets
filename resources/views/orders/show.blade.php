@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Order details #{{ $order->id }}</h2>

    <div class="card p-4 shadow">
        <h5>Information</h5>
        <ul>
            <li><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
            <li><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</li>
            <li><strong>Status:</strong> 
                @if($order->status == 'completed')
                    <span class="badge bg-success">Success</span>
                @elseif($order->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-danger">Fail</span>
                @endif
            </li>
        </ul>
    </div>

    <div class="card mt-4 p-4 shadow">
        <h5>Order credit details</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Credit Standard</th>
                    <th>Quantity</th>
                    <th>Price per ton</th>
                    <th>Total price</th>
                    <th>Project Name</th>
                    <th>Project Location</th>
                    <th>Serial Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->credit->standard->name ?? 'Not identified' }}</td>
                    <td>{{ $item->quantity }} tons</td>
                    <td>${{ number_format($item->price_per_ton, 2) }}</td>
                    <td>${{ number_format($item->total_price, 2) }}</td>
                    <td>{{ $item->credit->project->name ?? 'Not specified' }}</td>
                    <td>{{ $item->credit->project->location ?? 'Not specified' }}</td>
                    <td>
                        @if($item->credit->creditSerials)
                            @foreach ($item->credit->creditSerials as $serial)
                                {{ $serial->serial_code }}<br>
                            @endforeach
                        @else
                            No serial codes available
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('orders.index') }}">
        <button type="button" class="btn btn-outline-secondary">Return</button>
    </a>
</div>
@endsection
