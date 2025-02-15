@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<section class="product-page-container">
    {{-- <a href="{{ url()->previous() }}" >
        <button class="btn btn-outline-secondary position-absolute start-5 ms-5 mt-5">&larr; Back</button>
    </a>  --}}
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
            <!-- Project Info and Map Section -->
            <div class="row">
                <!-- Google Map Section on the Left -->
                {{-- <div class="col-md-6">
                    <div class="google-map">
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center=21.0285,105.8542&zoom=14&size=600x300&markers=color:red%7Clabel:C%7C21.0285,105.8542&key=YOUR_API_KEY" alt="Google Map">
                    </div>
                </div> --}}
        
                <!-- Project Info Section on the Right -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h3 class="product-desc-title">Project Info</h3>
                        <p class="product-desc"><strong>Country:</strong> <span>{{ $carbonProject->location }}</span></p>
                        <p class="product-desc"><strong>Company:</strong> <span>{{ $carbonProject->developer }}</span></p>
                        <p class="product-desc"><strong>Address:</strong> <span>{{ $carbonProject->address }}</span></p>
                        <p class="product-desc"><strong>Type:</strong> <span>{{ $carbonProject->projectType->type_name }}</span></p>
                    </div>
                </div>
            </div>
        <hr class="group-divider">
        <!--Certification Info-->
        <section class="certification-section">
            <span class="product-desc-title">Gallery</span>
            <hr class="group-divider">
                @if ($carbonProject->images->count() > 1)
                    <!-- Nếu có nhiều ảnh, hiển thị Carousel -->
                    <div id="imageCarousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach ($carbonProject->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/'.$image->image_path) }}" 
                                        class="d-block w-100 rounded shadow" 
                                        alt="Project Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Nút điều hướng Previous & Next -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @elseif ($carbonProject->images->count() === 1)
                    <!-- Nếu chỉ có 1 ảnh, hiển thị đơn giản -->
                    <div class="product-thumbnail text-center">
                        <img src="{{ asset('storage/'.$carbonProject->images->first()->image_path) }}" 
                            class="img-fluid rounded shadow" 
                            alt="Project Image">
                    </div>
                @endif
            <h4>Certification</h4>
            <div class="certification-table">
                <div class="row">
                    <div class="col-md-3"><strong>Validator</strong></div>
                    <div class="col-md-3">{{ $carbonProject->credits->first()->validator }}</div>
                    <div class="col-md-3"><strong>Status</strong></div>
                    <div class="col-md-3">{{ $carbonProject->credits->first()->status }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Type</strong></div>
                    <div class="col-md-3">{{ $carbonProject->projectType->type_name }}</div>
                    <div class="col-md-3"><strong>Standards</strong></div>
                    <div class="col-md-3">{{ $carbonProject->credits->first()->standard->name }}</div>
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
                    {{-- <button type="submit" class="btn btn-primary" style="border-radius: 25px">Add to cart</button> --}}
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
