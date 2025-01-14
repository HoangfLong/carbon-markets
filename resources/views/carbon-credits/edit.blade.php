@extends('layouts.index')

@section('content')
    <h1 class="text-center text-white mb-4">Edit Carbon Credit</h1>

    <div class="card bg-dark text-white mx-auto" style="max-width: 600px; padding: 20px; border-radius: 10px;">
        <form action="{{ route('credits.update', $carbonCredits) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Project Dropdown -->
            <div class="form-group mb-3">
                <label for="project_ID">Select Project</label>
                <select name="project_ID" id="project_ID" class="form-select bg-secondary text-dark border-0 rounded">
                    @foreach ($carbonProjects as $project)
                        <option value="{{ $project->id }}" {{ $carbonCredits->project_ID == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_ID')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Serial Number -->
            <div class="form-group mb-3">
                <label for="serial_number">Serial Number</label>
                <input type="text" name="serial_number" id="serial_number" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('serial_number', $carbonCredits->serial_number) }}" readonly>
                @error('serial_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Price Per Ton -->
            <div class="form-group mb-3">
                <label for="price_per_ton">Price Per Ton</label>
                <input type="number" name="price_per_ton" id="price_per_ton" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('price_per_ton', $carbonCredits->price_per_ton) }}" step="0.01" min="0" required>
                @error('price_per_ton')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Quantity Available -->
            <div class="form-group mb-3">
                <label for="quantity_available">Quantity Available</label>
                <input type="number" name="quantity_available" id="quantity_available" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('quantity_available', $carbonCredits->quantity_available) }}" min="1" required>
                @error('quantity_available')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Minimum Purchase -->
            <div class="form-group mb-3">
                <label for="minimum_purchase">Minimum Purchase</label>
                <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('minimum_purchase', $carbonCredits->minimum_purchase) }}" min="1" required>
                @error('minimum_purchase')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select bg-secondary text-dark border-0 rounded">
                    <option value="available" {{ $carbonCredits->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold" {{ $carbonCredits->status == 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="retired" {{ $carbonCredits->status == 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="form-group mb-3">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('start_date', $carbonCredits->start_date) }}">
                @error('start_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- End Date -->
            <div class="form-group mb-3">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control bg-secondary text-white border-0 rounded" value="{{ old('end_date', $carbonCredits->end_date) }}">
                @error('end_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Update Carbon Credit</button>
            </div>
        </form>
    </div>
@endsection
