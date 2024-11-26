<x-app-layout>
    @section('content')
    <h1 style="color: #ffffff; text-align: center; margin-bottom: 20px;">Edit Carbon Credit</h1>

    <div style="background-color: #343a40; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto;">
        <form action="{{ route('carbon-credits.update', $carbonCredits) }}" method="POST" style="color: white;">
            @csrf
            @method('PUT')

            <!-- Project Dropdown -->
            <div class="form-group">
                <label for="project_id">Select Project</label>
                <select name="project_id" id="project_id" class="form-control" style="background-color: #495057; color: white; border: none; border-radius: 5px;">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $carbonCredit->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <!-- Serial Number -->
            <div class="form-group">
                <label for="serial_number">Serial Number</label>
                <input type="text" name="serial_number" id="serial_number" class="form-control" style="background-color: #495057; color: white; border: none; border-radius: 5px;" value="{{ old('serial_number', $carbonCredit->serial_number) }}">
                @error('serial_number')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <!-- Value -->
            <div class="form-group">
                <label for="value">Value</label>
                <input type="number" name="value" id="value" class="form-control" style="background-color: #495057; color: white; border: none; border-radius: 5px;" value="{{ old('value', $carbonCredit->value) }}">
                @error('value')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" style="background-color: #495057; color: white; border: none; border-radius: 5px;">
                    <option value="available" {{ $carbonCredit->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold" {{ $carbonCredit->status == 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="retired" {{ $carbonCredit->status == 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
                @error('status')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" class="btn btn-primary" style="background-color: #007bff; border: none; padding: 10px 20px; font-size: 16px; color: white; border-radius: 5px;">Update Carbon Credit</button>
            </div>
        </form>
    </div>
    @endsection
</x-app-layout>
