<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Card for Payment Cancelled Message -->
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <!-- Icon for Cancellation -->
                    <div class="mb-4">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 50px;"></i>
                    </div>

                    <!-- Title and Message -->
                    <h4 class="card-title text-danger">Payment Cancelled</h4>
                    <p class="card-text text-muted">We're sorry, but your payment was cancelled. Please try again later, or if the problem persists, contact our support team for assistance.</p>
                    
                    <!-- Buttons for Next Steps -->
                    {{-- <div class="d-grid gap-2 d-sm-block mt-4">
                        <a href="{{ route('payment.retry') }}" class="btn btn-outline-danger w-100">
                            <i class="bi bi-arrow-repeat"></i> Try Again
                        </a>
                        <a href="{{ route('contact.support') }}" class="btn btn-outline-primary w-100 mt-2">
                            <i class="bi bi-headset"></i> Contact Support
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>