@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class ="card">
        <div class="card-header">
            <h3>Project details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong>{{ $carbonProjects->name }}</p>
            <p><strong>description:</strong>{{ $carbonProjects->description }}</p>
            <p><strong>developer:</strong>{{ $carbonProjects->developer }}</p>
            <p><strong>start date:</strong>{{ $carbonProjects->start_date }}</p>
            <p><strong>end date:</strong>{{ $carbonProjects->end_date }}</p>
            <a href="{{ route('carbon-projects.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection