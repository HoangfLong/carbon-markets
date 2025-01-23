@extends('layouts.app')

@section('content')
<section class="product-page-container">
    <div class="product-details">
        <div class="product-thumbnail">
            <img src="{{ asset('storage/'.$carbonProject->images->first()->image_path) }}" alt="Product Image">
        </div>
        <div class="product-info">
            <span class="product-tag">Tag ở đây</span>
            <h2 class="product-name">{{$carbonProject->name}}</h2>
            <p class="product-price">${{ $carbonProject->credits->first()->price_per_ton ?? 'N/A' }}</p>
            <span class="product-desc-title">Description</span>
            <p class="product-desc">{{ $carbonProject->description }}</p>
        </div>
    </div>

    <div class="payment-section">
        <form action="{{ route('payment.checkout', $carbonProject->id) }}" method="POST" id="checkoutForm">
            @csrf
            <div class="pricing-card">
                <h4>Pricing</h4>
                <p id="pricePerTon">${{ $carbonProject->credits->first()->price_per_ton }} /tCO<sub>2</sub>e</p>

                <div class="amount-select">
                    <label for="amount">Amount</label>
                    <div class="input-group">
                        <button type="button" class="btn" id="decreaseAmount">-</button>
                        <input type="number" id="amount" name="amount" value="1" min="1" max="{{ $carbonProject->credits->first()->quantity_available }}">
                        <button type="button" class="btn" id="increaseAmount">+</button>
                    </div>
                    <span>tCO<sub>2</sub>e</span>
                </div>

                <div class="summary">
                    <p>Discount: <span id="discount">- €0.00</span></p>
                    <p>Transaction fee: <span id="transactionFee">€0.30</span></p>
                    <p>VAT: <span id="vat">€0.00</span></p>
                    <p>Total: <strong id="totalPrice">€0.00</strong></p>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Buy now</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const pricePerTon = parseFloat(document.getElementById("pricePerTon").textContent.replace(/[^0-9.]/g, ""));
    const discountElement = document.getElementById("discount");
    const transactionFeeElement = document.getElementById("transactionFee");
    const vatElement = document.getElementById("vat");
    const totalPriceElement = document.getElementById("totalPrice");

    const minAmount = parseInt(amountInput.min);
    const maxAmount = parseInt(amountInput.max);

    function calculatePricing() {
        const amount = parseInt(amountInput.value);
        const discount = amount >= 20000 ? amount * pricePerTon * 0.1 : 0;
        const transactionFee = 0.30;
        const vat = (amount * pricePerTon - discount) * 0.2;
        const totalPrice = amount * pricePerTon - discount + transactionFee + vat;

        discountElement.textContent = `- $${discount.toFixed(2)}`;
        transactionFeeElement.textContent = `$${transactionFee.toFixed(2)}`;
        vatElement.textContent = `$${vat.toFixed(2)}`;
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    }

    amountInput.addEventListener("input", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue < minAmount) {
            amountInput.value = minAmount;
        } else if (currentValue > maxAmount) {
            amountInput.value = maxAmount;
        }
        calculatePricing();
    });

    calculatePricing();
});
</script>
@endsection
