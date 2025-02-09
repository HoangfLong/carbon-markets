@php
    $hideWelcomeSection = true;
@endphp
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg p-4 text-center" style="max-width: 450px;">
        <div class="card-body">
            <h2 class="text-primary fw-bold">{{ __('Verify Your Email') }}</h2>
            <p class="text-muted">
                {{ __('Thanks for signing up! Please check your email and click on the verification link to activate your account.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}" class="d-grid gap-2">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-envelope-check"></i> {{ __('Resend Verification Email') }}
                </button>
            </form>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                </button>
            </form>

            <div class="mt-3">
                <small class="text-muted">
                    {{ __('Didn\'t receive the email? Check your spam folder or try resending.') }}
                </small>
            </div>
        </div>
    </div>
</div>
