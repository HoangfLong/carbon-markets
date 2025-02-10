@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class ="card">
        <div class="card-header">
            <h3>Project details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name: </strong>{{ $carbonProjects->name }}</p>
            <p><strong>Description: </strong>{{ $carbonProjects->description }}</p>
            <p><strong>Project Type: </strong>{{ $carbonProjects->projectType->type_name ?? 'N/A' }}</p>
            <p><strong>Developer: </strong>{{ $carbonProjects->developer }}</p>
            <p><strong>Address: </strong>{{ $carbonProjects->address }}</p>
            <p><strong>Status: </strong>{{ ucfirst($carbonProjects->status )}}</p>
            <p><strong>Total credits: </strong>{{ $carbonProjects->total_credits }}</p>
            <p><strong>Location: </strong>{{ $carbonProjects->location }}</p>
            <p><strong>Verified: </strong>
                @if ($carbonProjects->is_verified)
                    <span >Yes</span>
                @else
                    <span >No</span>
                @endif
            </p>
            <p><strong>Registered At: </strong>{{ $carbonProjects->registered_at }}</p>
            <h3>Images:</h3>
                @if ($carbonProjects->images->count() > 1)
                <!-- Nếu có nhiều ảnh, hiển thị Carousel -->
                <div id="imageCarousel" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($carbonProjects->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/'.$image->image_path) }}" 
                                    class="d-block mx-auto rounded shadow" 
                                    alt="Project Image {{ $index + 1 }}" 
                                    style="max-height: 150px; object-fit: contain;">
                            </div>
                        @endforeach
                    </div>
            
                    <!-- Nút điều hướng Previous & Next với màu mới -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev" style="color: #ff6347; font-size: 20px;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next" style="color: #ff6347; font-size: 20px;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @elseif ($carbonProjects->images->count() === 1)
                    <!-- Nếu chỉ có 1 ảnh, hiển thị đơn giản -->
                    <div class="product-thumbnail text-center">
                        <img src="{{ asset('storage/'.$carbonProjects->images->first()->image_path) }}" 
                            class="img-fluid rounded shadow" 
                            alt="Project Image" 
                            style="max-height: 150px; object-fit: contain;">
                    </div>
                @endif
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection