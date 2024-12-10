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
                        <th class="text-center border">Location</th>
                        <th class="text-center border">Developer</th>
                        <th class="text-center border">Description</th>
                        <th class="text-center border">Credits</th>
                        <th class="text-center border">Start Date</th>
                        <th class="text-center border">End Date</th>
                        <th class="text-center border">Created At</th>
                        <th class="text-center border">Updated At</th>
                        <th class="text-center border">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($carbonProjects as $project)
                        <tr>
                            <td class="text-center border">{{ $project->id }}</td>
                            <td class="text-center border">{{ $project->name }}</td>
                            <td class="text-center border">{{ $project->location }}</td>
                            <td class="text-center border">{{ $project->developer }}</td>
                            <td class="border">{{ Str::limit($project->description, 50, '...')}}</td>
                            <td class="text-center border">{{ $project->credits->count() }}</td>
                            <td class="text-center border">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') : 'N/A' }}</td>
                            <td class="text-center border">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'N/A' }}</td>
                            <td class="text-center border">{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="text-center border">{{ \Carbon\Carbon::parse($project->updated_at)->format('d/m/Y H:i') }}</td>
                            <td class="align-items-center">
                                <!-- View Icon -->
                                <a class="text-info mx-2" href="{{ route('carbon-projects.show',$project->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a class="text-primary mx-2" href="{{ route('carbon-projects.edit',$project->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                
                                <!-- Delete Icon -->
                                <form action="{{ route('carbon-projects.destroy',$project->id) }}" method="POST" class="d-inline-block">
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
            {{ $carbonProjects->links()}}
        </div>
    </div>
</div>
@endsection