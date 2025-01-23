@extends('layouts.app')

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
            <p><strong>Standard: </strong>{{ $carbonProjects->standard->name }}</p>
            <p><strong>Status: </strong>{{ ucfirst($carbonProjects->status )}}</p>
            <p><strong>Validator: </strong>{{ $carbonProjects->validator }}</p>
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
            <p><strong>start date: </strong>{{ $carbonProjects->start_date }}</p>
            <p><strong>end date: </strong>{{ $carbonProjects->end_date }}</p>
            <h3>Images:</h3>
            @if($carbonProjects->images && $carbonProjects->images->count() > 0)
                @foreach($carbonProjects->images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Project Image" style="width: 300px;">
                @endforeach
            @else
                <p>No images found for this project.</p>
            @endif
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection