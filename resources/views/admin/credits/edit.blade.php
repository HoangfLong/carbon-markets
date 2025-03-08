@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow-lg border-0 rounded-lg w-100" style="min-width: 135%; max-width: 100%;">
            <div class="card-body bg-light p-4">
                <h1 class="text-center mb-4 text-dark font-weight-bold">Edit Carbon Credit</h1>
                <!-- Hiển thị thông báo thành công -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Hiển thị lỗi xác thực -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('credits.update', $credits->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Project Dropdown -->
                    <div class="form-group mb-3">
                        <label for="project_ID" class="text-dark">Select Project</label>
                        <select name="project_ID" id="project_ID" class="form-select bg-light text-dark border-0 rounded">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ $credits->project_ID == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_ID')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Price Per Ton -->
                    <div class="form-group mb-3">
                        <label for="price_per_ton" class="text-dark">Price Per Ton</label>
                        <input type="number" name="price_per_ton" id="price_per_ton" class="form-control bg-light text-dark border-0 rounded" value="{{ old('price_per_ton', $credits->price_per_ton) }}" step="0.01" min="0" required>
                        @error('price_per_ton')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Standard ID -->
                    <div class="mb-4">
                        <label for="standard_id" class="form-label">Standard</label>
                        <select name="standard_id" id="standard_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Standard --</option>
                        @foreach($standards as $standard)
                            <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a standard.</div>
                    </div>

                    <!-- Validator -->
                    <div class="mb-4">
                        <label for="validator" class="form-label">Validator</label>
                        <input type="text" name="validator" id="validator" class="form-control" placeholder="Enter Validator Name">
                    </div>

                    <!-- Quantity Available -->
                    <div class="form-group mb-3">
                        <label for="quantity_available" class="text-dark">Quantity Available</label>
                        <input type="number" name="quantity_available" id="quantity_available" class="form-control bg-light text-dark border-0 rounded" value="{{ old('quantity_available', $credits->quantity_available) }}" min="1" required>
                        @error('quantity_available')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Minimum Purchase -->
                    <div class="form-group mb-3">
                        <label for="minimum_purchase" class="text-dark">Minimum Purchase</label>
                        <input type="number" name="minimum_purchase" id="minimum_purchase" class="form-control bg-light text-dark border-0 rounded" value="{{ old('minimum_purchase', $credits->minimum_purchase) }}" min="1" required>
                        @error('minimum_purchase')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status" class="text-dark">Status</label>
                        <select name="status" id="status" class="form-select bg-light text-dark border-0 rounded">
                            <option value="Registered" {{ $credits->status == 'Registered' ? 'selected' : '' }}>Registered</option>
                            <option value="Retired" {{ $credits->status == 'Retired' ? 'selected' : '' }}>Retired</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div class="form-group mb-3">
                        <label for="start_date" class="text-dark">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control bg-light text-dark border-0 rounded" value="{{ old('start_date', $credits->start_date) }}">
                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="form-group mb-3">
                        <label for="end_date" class="text-dark">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control bg-light text-dark border-0 rounded" value="{{ old('end_date', $credits->end_date) }}">
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
        </div>
    </div>
@endsection
