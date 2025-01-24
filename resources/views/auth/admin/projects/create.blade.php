@extends('auth.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Create New Project</h2>
        </div>
        <div class="card-body">
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

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <!-- Project Type -->
                <div class="mb-4">
                    <label for="project_type_ID" class="form-label">Project Type</label>
                    <select name="project_type_ID" id="project_type_ID" class="form-select" required>
                        <option value="" disabled selected>-- Select Project Type --</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a project type.</div>
                </div>

                <!-- Standard -->
                <div class="mb-4">
                    <label for="standards_ID" class="form-label">Standard</label>
                    <select name="standards_ID" id="standards_ID" class="form-select" required>
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

                <!-- Project Name -->
                <div class="mb-4">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Project Name" required>
                    <div class="invalid-feedback">Project name is required.</div>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Enter Project Location">
                </div>

                <!-- Developer -->
                <div class="mb-4">
                    <label for="developer" class="form-label">Developer</label>
                    <input type="text" name="developer" id="developer" class="form-control" placeholder="Enter Developer Name">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Project Description" required></textarea>
                    <div class="invalid-feedback">Description is required.</div>
                </div>

                <!-- Start Date & End Date -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                </div>

                <!-- Registered At -->
                <div class="mb-4">
                    <label for="registered_at" class="form-label">Registered At</label>
                    <input type="date" name="registered_at" id="registered_at" class="form-control">
                </div>

                <!-- Total Credits -->
                <div class="mb-4">
                    <label for="total_credits" class="form-label">Total Credits</label>
                    <input type="number" step="0.01" name="total_credits" id="total_credits" class="form-control" placeholder="Enter Total Credits" required>
                    <div class="invalid-feedback">Total credits are required.</div>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                    <div class="invalid-feedback">Please select the project status.</div>
                </div>

                <!-- Is Verified -->
                <div class="mb-4">
                    <label for="is_verified" class="form-label">Is Verified</label>
                    <select name="is_verified" id="is_verified" class="form-select" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <div class="invalid-feedback">Please select verification status.</div>
                </div>

                <!-- Upload Images -->
                <div class="mb-4">
                    <label for="images" class="form-label">Upload Images</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="form-text text-muted">
                        You can upload multiple images. Only JPG, JPEG, PNG formats are allowed (Max size: 2MB per image).
                    </small>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save Project</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript to enable validation -->
<script>
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
