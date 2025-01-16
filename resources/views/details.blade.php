@extends('layouts.index')
@section('content')
<section class="product-page-container">
    <!-- Left Content -->
    <div class="product-details">
        <!-- Product Thumbnail -->
        <div class="product-thumbnail">
            <img src="{{ asset('storage/'.$carbonProjects->images->first()->image_path) }}" alt="Product Image">
        </div>
        <!-- Product Description -->
        <div class="product-info">
            <span class="product-tag">Cái tag ở đây</span>
            <h2 class="product-name">{{$carbonProjects->name}}</h2>
            <p class="product-price">${{ $carbonProjects->credits->first()->price_per_ton ?? 'N/A' }}</p>
            <span class="product-desc-title">Description</span>
            <p class="product-desc">{{ $carbonProjects->description }}</p>
        </div>
    </div>

    <!-- Payment Section -->
    <div class="payment-section">
        <div class="pricing-card">
            <h4>Pricing</h4>
            <p>${{ $carbonProjects->credits->first()->price_per_ton }} /tCO<sub>2</sub>e</p>

            <div class="amount-select">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <button class="btn" id="decreaseAmount">-</button>
                    <input type="number" id="amount" value="10000" min="10000" max="70300">
                    <button class="btn" id="increaseAmount">+</button>
                </div>
                <span>tCO<sub>2</sub>e</span>
            </div>

            <!-- Available Stock & Minimum Purchase -->
            <div class="product-info">
                <p><strong>Available stock:</strong> {{ $carbonProjects->credits->first()->quantity_available }} UD</p>
                <p><strong>Minimum purchases:</strong> {{ $carbonProjects->credits->first()->minimum_purchase }} UD</p>
            </div>

            <div class="summary">
                <p>Discount: <span class="discount">- €2,245.88</span></p>
                <p>Transaction fee: <span>€0.30</span></p>
                <p>VAT: <span>€0.00</span></p>
                <p>Total: <strong>€16,112.01</strong></p>
            </div>

            <div class="actions">
                <button class="btn btn-primary">Buy now €16,112.01</button>
                <button class="btn btn-secondary">Add to cart</button>
                <button class="btn btn-outline">Make an offer</button>
            </div>
        </div>
    </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const decreaseButton = document.getElementById("decreaseAmount");
    const increaseButton = document.getElementById("increaseAmount");
    const amountInput = document.getElementById("amount");
    const minAmount = parseInt(amountInput.min);
    const maxAmount = parseInt(amountInput.max);

    decreaseButton.addEventListener("click", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue > minAmount) {
            amountInput.value = currentValue - 1;
        }
    });

    increaseButton.addEventListener("click", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue < maxAmount) {
            amountInput.value = currentValue + 1;
        }
    });

    amountInput.addEventListener("input", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue < minAmount) {
            amountInput.value = minAmount;
        } else if (currentValue > maxAmount) {
            amountInput.value = maxAmount;
        }
    });
  });
</script>
@endsection
