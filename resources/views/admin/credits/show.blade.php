@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center">
            <h1 class="mb-0">Credit Details</h1>
        </div>
        <div class="card-body bg-white p-5">
            <!-- Chi tiết Credit -->
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <p><strong>Project Name:</strong> {{ $carbonCredits->project->name ?? 'N/A' }}</p>
                        <p><strong>Price per Ton:</strong> ${{ number_format($carbonCredits->price_per_ton, 2) }}</p>
                        <p><strong>Quantity Available:</strong> {{ $carbonCredits->quantity_available }}</p>
                        <p><strong>Minimum Purchase:</strong> {{ $carbonCredits->minimum_purchase }}</p>
                        <p><strong>Standard:</strong> {{ $carbonCredits->standard->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <p><strong>Validator:</strong> {{ $carbonCredits->validator }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $carbonCredits->status === 'available' ? 'success' : ($carbonCredits->status === 'sold' ? 'warning' : 'danger') }}">
                                {{ ucfirst($carbonCredits->status) }}
                            </span>
                        </p>
                        <p><strong>Start Date:</strong> {{ $carbonCredits->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $carbonCredits->end_date }}</p>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-4">
                <a href="{{ route('credits.index') }}" class="btn btn-secondary">
                    Back to Credits
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
