@extends('layouts.index')
@section('content')
<section class="product-page-container">
    <!-- Left Content -->
    <div class="product-details">
        <div class="product-thumbnail">
            <img src="{{ asset('storage/'.$carbonProjects->images->first()->image_path) }}" alt="Product Image">
        </div>
        <div class="product-info">
            <span class="product-tag">Tag</span>
            <h2 class="product-name">{{$carbonProjects->name}}</h2>
            <p class="product-price">${{ $carbonProjects->credits->first()->price_per_ton ?? 'N/A' }}</p>
            <span class="product-desc-title">Description</span>
            <p class="product-desc">{{ $carbonProjects->description }}</p>
        </div>
    </div>

    <!-- Payment Section -->
    <div class="payment-section">
        <form action="{{ route('details',$carbonProjects->id) }}" method="POST" id="checkoutForm">
            @csrf
            <div class="pricing-card">
                <h4>Pricing</h4>
                <p id="pricePerTon">${{ $carbonProjects->credits->first()->price_per_ton }} /tCO<sub>2</sub>e</p>

                <div class="amount-select">
                    <label for="amount">Amount</label>
                    <div class="input-group">
                        <button type="button" class="btn" id="decreaseAmount">-</button>
                        <input type="number" id="amount" name="amount" value="" min="" max="{{ $carbonProjects->credits->first()->quantity_available }}">
                        <button type="button" class="btn" id="increaseAmount">+</button>
                    </div>
                    <span>tCO<sub>2</sub>e</span>
                </div>

                <!-- Pricing Summary -->
                <div class="summary">
                    <p>Discount: <span id="discount">- €0.00</span></p>
                    <p>Transaction fee: <span id="transactionFee">€0.30</span></p>
                    <p>VAT: <span id="vat">€0.00</span></p>
                    <p>Total: <strong id="totalPrice">€0.00</strong></p>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Buy now</button>
                    <button type="button" class="btn btn-secondary">Add to cart</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const decreaseButton = document.getElementById("decreaseAmount");
    const increaseButton = document.getElementById("increaseAmount");
    const amountInput = document.getElementById("amount");
    const pricePerTon = parseFloat(document.getElementById("pricePerTon").textContent.replace(/[^0-9.]/g, ""));
    const discountElement = document.getElementById("discount");
    const transactionFeeElement = document.getElementById("transactionFee");
    const vatElement = document.getElementById("vat");
    const totalPriceElement = document.getElementById("totalPrice");
    const checkoutForm = document.getElementById("checkoutForm");  // Thêm phần này để truy cập form

    const minAmount = parseInt(amountInput.min);
    const maxAmount = parseInt(amountInput.max);

    function calculatePricing() {
        const amount = parseInt(amountInput.value);
        const discount = amount >= 20000 ? amount * pricePerTon * 0.1 : 0; // 10% discount for orders >= 20000
        const transactionFee = 0.30;
        const vat = (amount * pricePerTon - discount) * 0.2; // 20% VAT
        const totalPrice = amount * pricePerTon - discount + transactionFee + vat;

        discountElement.textContent = `- $${discount.toFixed(2)}`;
        transactionFeeElement.textContent = `$${transactionFee.toFixed(2)}`;
        vatElement.textContent = `$${vat.toFixed(2)}`;
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    }

    decreaseButton.addEventListener("click", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue > minAmount) {
            amountInput.value = currentValue - 1;
            calculatePricing();
        }
    });

    increaseButton.addEventListener("click", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue < maxAmount) {
            amountInput.value = currentValue + 1;
            calculatePricing();
        }
    });

    amountInput.addEventListener("input", function () {
        let currentValue = parseInt(amountInput.value);
        if (currentValue < minAmount) {
            amountInput.value = minAmount;
        } else if (currentValue > maxAmount) {
            amountInput.value = maxAmount;
        }
        calculatePricing();
    });

    // Xử lý khi bấm vào Buy Now
    checkoutForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Ngừng việc gửi form mặc định để có thể xử lý logic thêm vào trước khi gửi

        // Gửi form sau khi tính toán
        checkoutForm.submit(); // Gửi form thực sự để chuyển hướng tới hành động "checkout"
    });

    calculatePricing();
});
</script>
@endsection
