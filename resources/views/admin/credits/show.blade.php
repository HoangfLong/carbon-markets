@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body bg-light p-4">
            <h1 class="text-center mb-4 text-dark font-weight-bold">Credit Details</h1>
            
            <!-- Credit Details -->
            <div class="row">
                <div class="col-md-6">
                    <h5><strong>Project Name:</strong> {{ $carbonCredits->projects->name ?? 'N/A' }}</h5>
                    <h5><strong>Price per Ton:</strong> ${{ number_format($carbonCredits->price_per_ton, 2) }}</h5>
                    <h5><strong>Quantity Available:</strong> {{ $carbonCredits->quantity_available }}</h5>
                    <h5><strong>Minimum Purchase:</strong> {{ $carbonCredits->minimum_purchase }}</h5>
                    <h5><strong>Standard:</strong> {{ $carbonCredits->standard->name ?? 'N/A' }}</h5>
                </div>
                <div class="col-md-6">
                    <h5><strong>Validator:</strong> {{ $carbonCredits->validator }}</h5>
                    <h5><strong>Status:</strong> 
                        <span class="badge" style="background-color: 
                            {{ $carbonCredits->status === 'available' ? '#28a745' : ($carbonCredits->status === 'sold' ? '#ffc107' : '#dc3545') }};
                            padding: 5px 10px; border-radius: 5px; color: white;">
                            {{ ucfirst($carbonCredits->status) }}
                        </span>
                    </h5>
                    <h5><strong>Start Date:</strong> {{ $carbonCredits->start_date }}</h5>
                    <h5><strong>End Date:</strong> {{ $carbonCredits->end_date }}</h5>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('credits.index') }}" class="btn btn-secondary">Back to Credits</a>
                {{-- <a href="{{ route('credits.edit', $carbonCredits) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('credits.destroy', $carbonCredits) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this credit?')">Delete</button>
                </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection
