@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Project Details</h3>
        </div>
        <div class="card-body bg-light p-4">
            <!-- Chi tiết dự án -->
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $project->name }}</p>
                    <p><strong>Description:</strong> {{ $project->description }}</p>
                    <p><strong>Project Type:</strong> {{ $project->projectType->type_name ?? 'N/A' }}</p>
                    <p><strong>Developer:</strong> {{ $project->developer }}</p>
                    <p><strong>Address:</strong> {{ $project->address }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $project->status === 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </p>
                    <p><strong>Total Credits:</strong> {{ $project->total_credits }}</p>
                    <p><strong>Location:</strong> {{ $project->location }}</p>
                    <p><strong>Verified:</strong> 
                        <span class="badge bg-{{ $project->is_verified ? 'success' : 'secondary' }}">
                            {{ $project->is_verified ? 'Yes' : 'No' }}
                        </span>
                    </p>
                    <p><strong>Registered At:</strong> {{ $project->registered_at }}</p>
                </div>
            </div>

            <!-- Hiển thị hình ảnh -->
            <h3 class="text-center mt-4">Project Images</h3>
            @if ($project->images->count() > 1)
                <div id="imageCarousel" class="carousel slide mt-3 shadow-lg" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($project->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/'.$image->image_path) }}" 
                                    class="d-block mx-auto img-thumbnail rounded shadow" 
                                    alt="Project Image {{ $index + 1 }}" 
                                    style="max-height: 300px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>

                    <!-- Nút điều hướng -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            @elseif ($project->images->count() === 1)
                <div class="text-center mt-3">
                    <img src="{{ asset('storage/'.$project->images->first()->image_path) }}" 
                        class="img-fluid rounded shadow-lg" 
                        alt="Project Image" 
                        style="max-height: 300px; object-fit: cover;">
                </div>
            @endif

            <!-- Nút quay lại -->
            <div class="text-center mt-4">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">⬅ Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
