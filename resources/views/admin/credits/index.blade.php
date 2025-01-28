@extends('layouts.admin.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-lg w-100" style="min-width: 135%; max-width: 100%;">
        <div class="card-body bg-light p-4">
            <h1 class="text-center mb-4 text-dark font-weight-bold">Credits</h1>
            
            <!-- Add Carbon Credit Button -->
            <div class="text-center mb-4">
                <a href="{{ route('credits.create') }}" class="btn btn-primary btn-lg" style="background-color: #007bff; border: none; padding: 12px 24px; font-size: 16px; color: white; border-radius: 5px; text-decoration: none;">
                    Add Carbon Credit
                </a>
            </div>

            <!-- Carbon Credits Table -->
            <table class="table table-bordered table-striped text-dark align-middle" style="width: 100%; table-layout: fixed;">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center border">ID</th>
                        <th class="text-center border">Value</th>
                        <th class="text-center border">Status</th>
                        <th class="text-center border">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($carbonCredits as $credit)
                        <tr>
                            <td class="text-center border">{{ $credit->id }}</td>
                            <td class="text-center border">{{ $credit->quantity_available }}</td>
                            <td class="text-center border">
                                <span class="badge" style="background-color: {{ $credit->status === 'available' ? '#28a745' : ($credit->status === 'sold' ? '#ffc107' : '#dc3545') }}; padding: 5px 10px; border-radius: 5px; color: white;">
                                    {{ ucfirst($credit->status) }}
                                </span>
                            </td>
                            <td class="text-center border">
                                <a href="{{ route('credits.show', $credit->id) }}">
                                    <button type="button" class="btn btn-outline-secondary m-1" >View</button>
                                </a>
                                <!-- Edit Button -->
                                <a href="{{ route('credits.edit', $credit) }}" class="btn btn-outline-warning m-1">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('credits.destroy', $credit) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger m-1" onclick="return confirm('Are you sure you want to delete this credit?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
