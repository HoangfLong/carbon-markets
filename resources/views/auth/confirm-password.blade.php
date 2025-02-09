@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4 text-center" style="max-width: 400px;">
        <div class="card-body">
            <h2 class="text-danger fw-bold">
                <i class="bi bi-shield-lock"></i> {{ __('Confirm Your Password') }}
            </h2>
            <p class="text-muted">
                {{ __('This is a secure area. Please confirm your password before proceeding.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="d-grid gap-3">
                @csrf

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password" class="fw-semibold">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-check-circle"></i> {{ __('Confirm') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
