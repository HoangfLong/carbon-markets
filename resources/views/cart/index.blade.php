@php
    $hideWelcomeSection = true;
    $hideFooterSection = true;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5 mb-5">
        <h2 class="mb-1">Your Shopping Cart</h2>

        @if($cartItems->isEmpty())
            <div class="alert alert-warning text-center">Your cart is empty! 🛍️</div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Project</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->credit->project->name ?? 'Unknown' }}</td>
                                            <td>
                                                <input type="number" class="form-control quantity-input" 
                                                    data-item-id="{{ $item->id }}"
                                                    value="{{ $item->quantity }}" min="1">
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td class="total-price">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                            <td>
                                                <form action="{{ route('cart.clear', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Thanh toán -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4>🧾 Order Summary</h4>
                            <hr>
                            <p><strong>Total Amount:</strong> <span id="grand-total">${{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->price), 2) }}</span></p>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary w-100">💳 Proceed to Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            const itemId = this.dataset.itemId;
            const newQuantity = this.value;

            console.log("Item ID:", itemId);  // Check the item ID
            console.log("New Quantity:", newQuantity);  // Check the new quantity value

            fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Cart updated successfully!");

                    // Find the row corresponding to this item and update the quantity and total
                    const itemRow = document.querySelector(`[data-item-id='${itemId}']`).closest('tr');
                    itemRow.querySelector('.quantity-input').value = newQuantity;  // Update quantity input field
                    itemRow.querySelector('.total-price').textContent = `$${(newQuantity * data.price).toFixed(2)}`;  // Update total price for this item

                    // Update the grand total
                    const grandTotal = document.getElementById('grand-total');
                    const totalAmount = Array.from(document.querySelectorAll('.total-price'))
                        .reduce((total, price) => total + parseFloat(price.textContent.replace('$', '').replace(',', '')), 0);
                    grandTotal.textContent = `$${totalAmount.toFixed(2)}`;
                } else {
                    console.log("Error:", data.message);
                    alert(data.message);
                }
            });
        });
    });
});
</script>
