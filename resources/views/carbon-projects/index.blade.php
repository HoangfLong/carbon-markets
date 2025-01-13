@extends('layouts.index')
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="min-width: 135%; max-width: 100%;">
        <div class="card-body bg-light p-4">
            <h1 class="text-center mb-4 text-dark font-weight-bold">Carbon Projects</h1>
            <table class="table table-bordered table-striped text-dark align-middle" style="width: 100%; table-layout: fixed;">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center border">Project ID</th>
                        <th class="text-center border">Project Name</th>
                        <th class="text-center border">Project Type</th>
                        <th class="text-center border">Standard</th>
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
                            <td class="text-center border">{{ $project->standard->name }}</td>
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
                                <a class="text-info mx-2" href="{{ route('projects.show', $project->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a class="text-primary mx-2" href="{{ route('projects.edit', $project->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Delete Icon -->
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Are you sure you want to delete this project?')">
                                        <i class="fa fa-trash"></i>
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
