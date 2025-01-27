@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<section class="product-page-container">
    <div class="product-details">
        <!--Project Info-->
        <div class="product-info">
            <span class="product-tag">Tag ở đây</span>
            <h2 class="product-name">{{$carbonProject->name}}</h2>
            <hr class="group-divider">
            <span class="product-desc-title">Description</span>
            <p class="product-desc">{{ $carbonProject->description }}</p>
        </div>
        <hr class="group-divider">
        <div class="product-info">
            <span class="product-desc-title">Project Info</span>
            <p class="product-desc">Country <span>{{ $carbonProject->location }}</span></p>
            <p class="product-desc">Company <span>{{ $carbonProject->developer }}</span></p>
            <p class="product-desc">Address <span>{{ $carbonProject->address }}</span></p>
            <p class="product-desc">Type <span>{{ $carbonProject->projectType->type_name }}</span></p>
        </div>
        <hr class="group-divider">

        <!--Certification Info-->
        <section class="certification-section">
            <div class="product-thumbnail">
                <img src="{{ asset('storage/'.$carbonProject->images->first()->image_path) }}" alt="Product Image">
            </div>
            <h4>Certification</h4>
            <div class="certification-table">
                <div class="row">
                    <div class="col-md-3"><strong>Validator</strong></div>
                    <div class="col-md-3">{{ $carbonProject->validator }}</div>
                    <div class="col-md-3"><strong>Status</strong></div>
                    <div class="col-md-3">{{ $carbonProject->status }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Type</strong></div>
                    <div class="col-md-3">{{ $carbonProject->projectType->type_name }}</div>
                    <div class="col-md-3"><strong>Standards</strong></div>
                    <div class="col-md-3">{{ $carbonProject->standard->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Credit start</strong></div>
                    <div class="col-md-3">{{ $carbonProject->credits->first()->start_date  }}</div>
                    <div class="col-md-3"><strong>Credit end</strong></div>
                    <div class="col-md-3">{{ $carbonProject->credits->first()->end_date }}</div>
                </div>
            </div>
        </section>        
    </div>

     <!--Payment Section-->
    <div class="payment-section">
        <form action="{{ route('payment.checkout', $carbonProject->id) }}" method="POST" id="checkoutForm">
            @csrf
            <div class="pricing-card">
                <h4>Pricing</h4>
                <p class="pricing-row">
                    <span id="pricePerTon">${{ $carbonProject->credits->first()->price_per_ton }} /tCO<sub>2</sub>e</span>
                </p>
                <div class="amount-select">
                    <hr class="group-divider">
                    <label for="amount">Amount</label>
                    <div class="input-group">
                        <button type="button" class="btn" id="decreaseAmount">-</button>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount" 
                            value="{{ $carbonProject->credits->first()->minimum_purchase }}" 
                            min="{{ $carbonProject->credits->first()->minimum_purchase }}" 
                            max="{{ $carbonProject->credits->first()->quantity_available }}">
                        <button type="button" class="btn" id="increaseAmount">+</button>
                    </div>
                    <span>tCO<sub>2</sub>e</span>
                </div>

                <div class="summary">
                    <hr class="group-divider">
                    <div class="grouped-info">
                        <p>Available: <span> {{ $carbonProject->credits->first()->quantity_available }} UD</span></p>
                        <p>Minimum purchases: <span>{{ $carbonProject->credits->first()->minimum_purchase }} UD</span></p>
                    </div>
                    <hr class="group-divider">
                    <p>Discount: <span id="discount">- €0.00</span></p>
                    <p>Transaction fee: <span id="transactionFee">€0.30</span></p>
                    <p>VAT: <span id="vat">€0.00</span></p>
                    <p>Total: <strong id="totalPrice">€0.00</strong></p>
                </div>
                <hr class="group-divider">
                <div class="actions">
                    <button type="submit" class="btn btn-primary" style="border-radius: 25px">Buy now</button>
                </div>
            </div>
        </form>
    </div>
</section>
<style>
 

</style>
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
