@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-body">
            <h2 class="text-center text-primary fw-bold">{{ __('Reset Password') }}</h2>
            <p class="text-muted text-center">
                {{ __('Enter your new password below to reset your account.') }}
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                    <input type="password" id="password" name="password" class="form-control" 
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">
                    <i class="bi bi-arrow-left"></i> {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
