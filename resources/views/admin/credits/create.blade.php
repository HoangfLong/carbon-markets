@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center text-dark mb-4">Add Carbon Credit Project</h1>

        <div class="card bg-light text-dark mx-auto" style="max-width: 100%; width: 100%;">
            <div class="card-body">
                <form action="{{ route('credits.store') }}" method="POST">
                    @csrf

                    <!-- Project Dropdown -->
                    <div class="form-group mb-3">
                        <label for="project_ID" class="text-dark">Select Project</label>
                        <select name="project_ID" id="project_ID" class="form-select bg-light text-dark border-0 rounded" required>
                            <option value="" disabled selected>-- Select a Project --</option>
                            @foreach ($carbonProjects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_ID')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Price Per Ton -->
                    <div class="form-group mb-3">
                        <label for="price_per_ton" class="text-dark">Price Per Ton</label>
                        <input type="number" name="price_per_ton" id="price_per_ton" class="form-control bg-light text-dark border-0 rounded" value="{{ old('price_per_ton') }}" step="0.01" min="0" required>
                        @error('price_per_ton')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Quantity Available -->
                    <div class="form-group mb-3">
                        <label for="quantity_available" class="text-dark">Quantity Available</label>
                        <input type="number" name="quantity_available" id="quantity_available" class="form-control bg-light text-dark border-0 rounded" value="{{ old('quantity_available') }}" min="1" required>
                        @error('quantity_available')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Minimum Purchase -->
                    <div class="form-group mb-3">
                        <label for="minimum_purchase" class="text-dark">Minimum Purchase</label>
                        <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control bg-light text-dark border-0 rounded" value="{{ old('minimum_purchase') }}" min="1" required>
                        @error('minimum_purchase')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status" class="text-dark">Status</label>
                        <select name="status" id="status" class="form-select bg-light text-dark border-0 rounded" required>
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="retired">Retired</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div class="form-group mb-3">
                        <label for="start_date" class="text-dark">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control bg-light text-dark border-0 rounded" value="{{ old('start_date') }}">
                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="form-group mb-3">
                        <label for="end_date" class="text-dark">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control bg-light text-dark border-0 rounded" value="{{ old('end_date') }}">
                        @error('end_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Create Carbon Credit Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
