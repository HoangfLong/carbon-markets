@extends('layouts.app')
    @section('content')
    <h1 style="color: #ffffff; text-align: center; margin-bottom: 20px;">Carbon Credits</h1>

    <div style="text-align: center; margin-bottom: 20px;">
        <a href="{{ route('credits.create') }}" class="btn btn-primary" style="background-color: #007bff; border: none; padding: 10px 20px; font-size: 16px; color: white; border-radius: 5px; text-decoration: none;">
            Add Carbon Credit
        </a>
    </div>

    <div class="table-responsive" style="background-color: #343a40; padding: 20px; border-radius: 10px;">
        <table class="table" style="color: white; text-align: center;">
            <thead style="background-color: #495057; color: white;">
                <tr>
                    <th>ID</th>
                    <th>Serial Number</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carbonCredits as $credit)
                    <tr style="border-bottom: 1px solid #6c757d;">
                        <td>{{ $credit->id }}</td>
                        <td>{{ $credit->serial_number }}</td>
                        <td>{{ $credit->quantity_available }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $credit->status === 'available' ? '#28a745' : ($credit->status === 'sold' ? '#ffc107' : '#dc3545') }}; padding: 5px 10px; border-radius: 5px; color: white;">
                                {{ ucfirst($credit->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('credits.edit', $credit) }}" class="btn btn-warning" style="margin-right: 5px; color: white;">
                                Edit
                            </a>
                            <form action="{{ route('credits.destroy', $credit) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" style="color: white;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div style="margin-top: 20px; text-align: center;">
        {{ $carbonCredits->links('pagination::bootstrap-4') }}
    </div> --}}
@endsection
