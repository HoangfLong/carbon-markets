@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2>Create New Project</h2>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hiển thị lỗi xác thực -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Project Type -->
        <div class="mb-3">
            <label for="project_type_ID" class="form-label">Project Type</label>
            <select name="project_type_ID" id="project_type_ID" class="form-select" required>
                <option value="">-- Select Project Type --</option>
                @foreach($projectTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Carbon Credit ID -->
        {{-- <div class="mb-3">
            <label for="carbon_credit_ID" class="form-label">Carbon Credit ID</label>
            <input type="number" name="carbon_credit_ID" id="carbon_credit_ID" class="form-control" required>
        </div> --}}

        <!-- Standard -->
        <div class="mb-3">
            <label for="standards_ID" class="form-label">Standard</label>
            <select name="standards_ID" id="standards_ID" class="form-select" required>
                <option value="">-- Select Standard --</option>
                @foreach($standards as $standard)
                    <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Validator -->
        <div class="mb-3">
            <label for="validator" class="form-label">Validator</label>
            <input type="text" name="validator" id="validator" class="form-control">
        </div>

        <!-- Project Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control">
        </div>

        <!-- Developer -->
        <div class="mb-3">
            <label for="developer" class="form-label">Developer</label>
            <input type="text" name="developer" id="developer" class="form-control">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>

        <!-- End Date -->
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>

        <!-- Registered At -->
        <div class="mb-3">
            <label for="registered_at" class="form-label">Registered At</label>
            <input type="date" name="registered_at" id="registered_at" class="form-control">
        </div>

        <!-- Total Credits -->
        <div class="mb-3">
            <label for="total_credits" class="form-label">Total Credits</label>
            <input type="number" step="0.01" name="total_credits" id="total_credits" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <!-- Is Verified -->
        <div class="mb-3">
            <label for="is_verified" class="form-label">Is Verified</label>
            <select name="is_verified" id="is_verified" class="form-select" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

         <!-- Upload Images -->
        <div class="mb-3">
            <label for="images" class="form-label">Upload Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            <small class="form-text text-muted">
                You can upload multiple images. Only JPG, JPEG, PNG formats are allowed (Max size: 2MB per image).
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Save Project</button>
    </form>
</div>
@endsection
