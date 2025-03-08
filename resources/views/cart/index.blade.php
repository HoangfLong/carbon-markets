@php
    $hideWelcomeSection = true;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5 mb-5">
        <h2 class="mb-4 text-center">Your Cart</h2>

        @if($cartItems->isEmpty())
            <div class="row justify-content-center" style="min-height: 70vh;">
                <div class="col-md-6">
                    <div class="text-center p-4">
                        <h4 class="mb-3">Your cart is currently empty!</h4>
                        <p class="mb-0">It seems you haven't added any items to your cart yet.</p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('market') }}">
                            <button class="btn btn-secondary btn-lg">🔙 Back to Marketplace</button>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8" style="margin-bottom: 130px;">
                    <div class="card shadow-sm mb-4">
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
                                        <tr class="hover-shadow">
                                            <td>{{ $item->credit->project->name ?? 'Unknown' }}</td>
                                            <td>
                                                <input type="number" class="quantity-input form-control" data-item-id="{{ $item->id }}" 
                                                min="{{ $item->quantity }}" 
                                                max="{{ $item->credit->quantity_available }}" 
                                                value="{{ $item->quantity }}">
                                                <small id="error-{{ $item->id }}" class="text-danger"></small> <!-- Error message -->   
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td class="total-price">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                            <td>
                                                <form action="{{ route('user.cart.clear', $item->id) }}" method="POST">
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

                <!-- Checkout -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4 p-4">
                        <h4 class="text-center">Order Summary</h4>
                        <hr class="group-divider">
                        <p>Transaction fee: <span id="transactionFee">$0.30</span></p>
                        <p>VAT: <span id="vat">$0.00</span></p>
                        <hr class="group-divider">
                        <p><strong>Total Amount:</strong><span id="grand-total" class="font-weight-bold">${{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->price), 2) }}</span></p>
                        <div class="actions text-center">
                            <form action="{{ route('user.cart.checkout') }}" method="POST">
                                @csrf
                                <button id="checkout-button" class="btn btn-primary w-100">Proceed to Checkout</button>
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
        const checkoutButton = document.getElementById('checkout-button'); // Nút thanh toán
    
        function validateInput(input) {
            const itemId = input.dataset.itemId;
            const minAmount = parseInt(input.min);
            const maxAmount = parseInt(input.max);
            let newQuantity = parseInt(input.value);
            const errorElement = document.querySelector(`#error-${itemId}`);
            let isValid = true;
    
            if (isNaN(newQuantity) || newQuantity < minAmount) {
                isValid = false;
                errorElement.textContent = `Minimum purchase ${minAmount}.`;
                input.classList.add('border-danger');
            } else if (newQuantity > maxAmount) {
                isValid = false;
                errorElement.textContent = `Quantity available ${maxAmount}.`;
                input.classList.add('border-danger');
            } else {
                errorElement.textContent = ""; // Xóa lỗi nếu hợp lệ
                input.classList.remove('border-danger');
            }
    
            return isValid;
        }
    
        function updateCheckoutButton() {
            let hasError = false;
            quantityInputs.forEach(input => {
                if (!validateInput(input)) {
                    hasError = true;
                }
            });
            checkoutButton.disabled = hasError;
        }
    
        quantityInputs.forEach(input => {
            input.addEventListener('input', function() {
                validateInput(this);
                updateCheckoutButton();
            });
    
            input.addEventListener('blur', function() { 
                if (!checkoutButton.disabled) {
                    const newQuantity = this.value;
                    const itemId = this.dataset.itemId;
    
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
                            const itemRow = document.querySelector(`[data-item-id='${itemId}']`).closest('tr');
                            itemRow.querySelector('.total-price').textContent = `$${(newQuantity * data.price).toFixed(2)}`;
    
                            const grandTotal = document.getElementById('grand-total');
                            const totalAmount = Array.from(document.querySelectorAll('.total-price'))
                                .reduce((total, price) => total + parseFloat(price.textContent.replace('$', '').replace(',', '')), 0);
                            grandTotal.textContent = `$${totalAmount.toFixed(2)}`;
                        } else {
                            console.log("Error:", data.message);
                            alert(data.message);
                        }
                    });
                }
            });
        });
    
        updateCheckoutButton();
    });
</script>
    