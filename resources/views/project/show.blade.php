@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<section class="product-page-container container">
    <div class="row">
        <!-- Cột hiển thị thông tin dự án -->
        <div class="col-lg-8">
            <div class="product-details">
                <!-- Thông tin dự án -->
                <div class="product-info">
                    <span class="product-tag badge bg-primary">Carbon Offset</span>
                    <h2 class="product-name mt-3">{{ $carbonProject->name }}</h2>
                    <hr class="group-divider">
                    <span class="product-desc-title">Description</span>
                    <p class="product-desc">{{ $carbonProject->description }}</p>

                    <!-- Thông tin chi tiết dự án -->
                    <hr class="group-divider">
                    <h3 class="product-desc-title">Project Info</h3>
                    <p class="product-desc"><strong>Country:</strong> {{ $carbonProject->location }}</p>
                    <p class="product-desc"><strong>Company:</strong> {{ $carbonProject->developer }}</p>
                    <p class="product-desc"><strong>Address:</strong> {{ $carbonProject->address }}</p>
                    <p class="product-desc"><strong>Type:</strong> {{ $carbonProject->projectType->type_name }}</p>
                </div>
                <!-- Thư viện ảnh -->
                <hr class="group-divider">
                <h4>Gallery</h4>
                @if ($carbonProject->images->count() > 1)
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
                    <div class="product-thumbnail text-center">
                        <img src="{{ asset('storage/'.$carbonProject->images->first()->image_path) }}" 
                            class="img-fluid rounded shadow" 
                            alt="Project Image">
                    </div>
                @endif
                <!-- Thông tin chứng nhận -->
                <hr class="group-divider">
                <h4>Certification</h4>
                <div class="certification-table mb-5 pb-5">
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
            </div>
        </div>

        <!-- Cột thanh toán (Cố định khi cuộn) -->
        <div class="col-lg-4">
            <div class="payment-section">
                <form action="{{ route('payment.checkout', $carbonProject->id) }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="pricing-card p-4 border rounded shadow">
                        <h4 class="text-center">Pricing</h4>
                        <p class="pricing-row">
                            <span id="pricePerTon">${{ $carbonProject->credits->first()->price_per_ton }} /tCO<sub>2</sub>e</span>
                        </p>
                        <hr class="group-divider">
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold">Amount</label>
                            <div class="input-group">
                                <input type="number" id="amount" name="amount" 
                                    value="{{ $carbonProject->credits->first()->minimum_purchase }}" 
                                    min="{{ $carbonProject->credits->first()->minimum_purchase }}" 
                                    max="{{ $carbonProject->credits->first()->quantity_available }}"
                                    class="form-control text-center" style="max-width: 150px;">
                                <span class="input-group-text">tCO<sub>2</sub>e</span>
                            </div>
                        </div>

                        <hr class="group-divider">
                        <div class="summary">
                            <p>Available: <span>{{ $carbonProject->credits->first()->quantity_available }} UD</span></p>
                            <p>Minimum purchase: <span>{{ $carbonProject->credits->first()->minimum_purchase }} UD</span></p>
                            <hr class="group-divider">
                            <p>Discount: <span id="discount">- $0.00</span></p>
                            <p>Transaction fee: <span id="transactionFee">$0.30</span></p>
                            <hr class="group-divider">
                            <p>VAT: <span id="vat">$0.00</span></p>
                            <p>Total: <strong id="totalPrice">$0.00</strong></p>
                        </div>
                        <hr class="group-divider">
                        <div class="actions text-center">
                            <button type="submit" class="btn btn-primary w-100">Buy now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const amountInput = document.getElementById("amount");
        const pricePerTon = parseFloat(document.getElementById("pricePerTon").textContent.replace(/[^0-9.]/g, ""));
        const transactionFeeElement = document.getElementById("transactionFee");
        const totalPriceElement = document.getElementById("totalPrice");
        const checkoutButton = document.querySelector("button[type='submit']"); // Nút "Buy now"
        const errorElement = document.createElement("p"); // Thông báo lỗi
        errorElement.style.color = "red";
        errorElement.style.fontSize = "14px";
        errorElement.style.display = "none"; // Mặc định ẩn
        amountInput.parentNode.appendChild(errorElement); // Thêm vào form
    
        const minAmount = parseInt(amountInput.min);
        const maxAmount = parseInt(amountInput.max);
    
        function calculatePricing() {
            let amount = amountInput.value.replace(/\D/g, ""); // Xóa ký tự không phải số
            if (amount.length > 6) {
                amount = amount.substring(0, 6); // Giới hạn tối đa 6 chữ số
            }
            amountInput.value = amount; // Cập nhật giá trị trong ô nhập
    
            const amountNum = parseInt(amount);
    
            // Kiểm tra số lượng hợp lệ
            if (isNaN(amountNum) || amountNum < minAmount) {
                errorElement.textContent = `⚠️ Minimum purchase is ${minAmount} tCO₂e.`;
                errorElement.style.display = "block";
                checkoutButton.disabled = true;
                checkoutButton.classList.add("disabled");
                return;
            } else if (amountNum > maxAmount) {
                errorElement.textContent = `⚠️ Only ${maxAmount} tCO₂e available.`;
                errorElement.style.display = "block";
                checkoutButton.disabled = true;
                checkoutButton.classList.add("disabled");
            } else {
                errorElement.style.display = "none"; // Ẩn lỗi khi hợp lệ
                checkoutButton.disabled = false;
                checkoutButton.classList.remove("disabled");
            }
    
            // Tính giá nếu hợp lệ
            const transactionFee = 0.30;
            const totalPrice = amountNum * pricePerTon + transactionFee;
    
            transactionFeeElement.textContent = `$${transactionFee.toFixed(2)}`;
            totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
        }
    
        amountInput.addEventListener("input", calculatePricing);
        
        calculatePricing(); // Gọi ngay khi tải trang
    });
</script>
@endsection
