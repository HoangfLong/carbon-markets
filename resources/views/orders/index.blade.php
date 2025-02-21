@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5 mb-5">
    <!-- Nút Back -->
    <a href="{{ route('dashboard') }}" >
        <button class="btn btn-outline-secondary">
            &larr; Back
        </button>
   </a>

    <h2 class="text-center mb-4">Your Order</h2>

    @if($orders->isEmpty())
        <div class="alert alert-warning text-center">Your order is empty.</div>
    @else
        <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
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
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination shadow-sm">
                    {{-- Previous --}}
                    @if ($orders->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Next --}}
                    @if ($orders->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
@endsection
