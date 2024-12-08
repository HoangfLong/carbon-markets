@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit Project</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('carbon-projects.update', $carbonProjects->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $carbonProjects->name }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $carbonProjects->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $carbonProjects->location }}">
                </div>
                <div class="mb-3">
                    <label for="developer" class="form-label">Developer</label>
                    <input type="text" class="form-control" id="developer" name="developer" value="{{ $carbonProjects->developer }}">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $carbonProjects->start_date }}">
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $carbonProjects->end_date }}">
                </div>
                <button type="submit" class="btn btn-success">Update Project</button>
                <a href="{{ route('carbon-projects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
