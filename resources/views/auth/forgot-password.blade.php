@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-body">
            <h2 class="text-center text-primary fw-bold">{{ __('Forgot Password?') }}</h2>
            <p class="text-muted text-center">
                {{ __('Enter your email address and we will send you a link to reset your password.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Reset Link') }}
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
