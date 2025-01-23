@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Edit Project</h3>
            <a href="{{ route('projects.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $carbonProjects->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Project Name -->
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label fw-bold">Project Name</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ $carbonProjects->name }}" required>
                    </div>

                    <!-- Developer -->
                    <div class="col-md-6 mb-4">
                        <label for="developer" class="form-label fw-bold">Developer</label>
                        <input type="text" class="form-control shadow-sm" id="developer" name="developer" value="{{ $carbonProjects->developer }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Project Type -->
                    <div class="col-md-6 mb-4">
                        <label for="project_type" class="form-label fw-bold">Project Type</label>
                        <select class="form-select shadow-sm" id="project_type" name="project_type_ID" required>
                            @foreach($projectTypes as $type)
                                <option value="{{ $type->id }}" {{ $carbonProjects->project_type_ID == $type->id ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Standard -->
                    <div class="col-md-6 mb-4">
                        <label for="standard" class="form-label fw-bold">Standard</label>
                        <select class="form-select shadow-sm" id="standard" name="standards_ID" required>
                            @foreach($standards as $standard)
                                <option value="{{ $standard->id }}" {{ $carbonProjects->standards_ID == $standard->id ? 'selected' : '' }}>
                                    {{ $standard->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Total Credits -->
                    <div class="col-md-6 mb-4">
                        <label for="total_credits" class="form-label fw-bold">Total Credits</label>
                        <input type="number" step="0.01" class="form-control shadow-sm" id="total_credits" name="total_credits" value="{{ $carbonProjects->total_credits }}" required>
                    </div>
                    <!-- Verified -->
                    <div class="col-md-6 mb-4">
                        <label for="is_verified" class="form-label fw-bold">Verified</label>
                        <select class="form-select shadow-sm" id="is_verified" name="is_verified" required>
                            <option value="1" {{ $carbonProjects->is_verified ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$carbonProjects->is_verified ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-4">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select class="form-select shadow-sm" id="status" name="status" required>
                            <option value="active" {{ $carbonProjects->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $carbonProjects->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ $carbonProjects->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Registered At -->
                    <div class="col-md-6 mb-4">
                        <label for="registered_at" class="form-label fw-bold">Registered At</label>
                        <input type="date" class="form-control shadow-sm" id="registered_at" name="registered_at" value="{{ $carbonProjects->registered_at }}">
                    </div>

                    <!-- Location -->
                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label fw-bold">Location</label>
                        <input type="text" class="form-control shadow-sm" id="location" name="location" value="{{ $carbonProjects->location }}">
                    </div>
                </div>

                <div class="row">
                    <!-- Start Date -->
                    <div class="col-md-6 mb-4">
                        <label for="start_date" class="form-label fw-bold">Start Date</label>
                        <input type="date" class="form-control shadow-sm" id="start_date" name="start_date" value="{{ $carbonProjects->start_date }}">
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6 mb-4">
                        <label for="end_date" class="form-label fw-bold">End Date</label>
                        <input type="date" class="form-control shadow-sm" id="end_date" name="end_date" value="{{ $carbonProjects->end_date }}">
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control shadow-sm" id="description" name="description" rows="4">{{ $carbonProjects->description }}</textarea>
                </div>

                <!-- Upload Images -->
                <div class="mb-4">
                    <label for="images" class="form-label fw-bold">Upload New Images</label>
                    <input type="file" class="form-control shadow-sm" id="images" name="images[]" multiple>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success shadow-sm"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary ms-3"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
