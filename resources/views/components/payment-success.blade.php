<div class="container mt-5 text-center">
    <div class="card p-5 shadow-lg">
        <h2 class="text-success"><i class="bi bi-check-circle-fill"></i>Payment Successful!</h2>
        <p class="mt-3">Thank you for your purchase. Your transaction has been completed.</p>
        <p><strong>Order ID:</strong> <span class="badge bg-primary">#{{ $order->id }}</span></p>

        <div class="mt-4">
            <a href="{{ route('orders.show', $order->id) }}" >
                <button class="btn btn-outline-primary bi bi-eye">View Order</button>
            </a>
            <a href="{{ route('home') }}">
                <button class="bi bi-house-door btn btn-secondary">Return to Home</button>
            </a>
        </div>
    </div>
</div>