@extends('layouts.admin.app')
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="min-width: 135%; max-width: 100%;">
        <div class="card-body bg-light p-4">
            <h1 class="text-center mb-4 text-dark font-weight-bold">Projects</h1>
                <!-- Add Carbon Credit Button -->
                <div class="text-center mb-4">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary btn-lg" style="background-color: #007bff; border: none; padding: 12px 24px; font-size: 16px; color: white; border-radius: 5px; text-decoration: none;">
                        Add Project
                    </a>
                </div>
            <table class="table table-bordered table-striped text-dark align-middle" style="width: 100%; table-layout: fixed;">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center border">Project ID</th>
                        <th class="text-center border">Project Name</th>
                        <th class="text-center border">Project Type</th>
                        <th class="text-center border">Status</th>
                        <th class="text-center border">Location</th>
                        <th class="text-center border">Verified</th>
                        <th class="text-center border">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($carbonProjects as $project)
                        <tr>
                            <td class="text-center border">{{ $project->id }}</td>
                            <td class="text-center border">{{ $project->name }}</td>
                            <td class="text-center border">{{ $project->projectType->type_name ?? 'N/A' }}</td>
                            <td class="text-center border">{{ ucfirst($project->status) }}</td>
                            <td class="text-center border">{{ $project->location }}</td>
                            <td class="text-center border">
                                @if ($project->is_verified)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            {{-- <td class="text-center border">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') : 'N/A' }}</td>
                            <td class="text-center border">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'N/A' }}</td> --}}
                            <td class="align-items-center">
                                
                                <!-- View Icon --> 
                                <a href="{{ route('projects.show', $project->id) }}">
                                    <button type="button" class="btn btn-outline-secondary m-1" >View</button>
                                </a>
                              
                                <!-- Edit Icon -->
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    <button type="button" class="btn btn-outline-warning m-1">Edit</button>
                                </a>

                                <!-- Delete Icon -->
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger m-1" onclick="return confirm('Are you sure you want to delete this project?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $carbonProjects->links() }} --}}
        </div>
    </div>
</div>
@endsection
