@extends('layouts.user.app')

@section('content')
    <div class="site-wrap d-md-flex align-items-stretch">
        <div class="bg-img" style="background-image: url('{{ asset('build/assets/img/img-bg-2.jpg') }}')">
            <a href="{{ url()->previous() }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="text-overlay">
                <h1 class="title">Welcome to the world of transparent climate action. Welcome to Esscence.</h1>
            </div>
        </div>
        <div class="form-wrap">
            <div class="form-inner">
                <h1 class="title">Sign up</h1>
                <p class="caption mb-4">Join us for today.</p>

                <form method="POST" action="{{ route('register') }}" class="pt-3">
                    @csrf

                    <!-- Name -->
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                        <label for="name">Full Name</label>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="info@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email Address</label>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-floating">
                        <input type="text" class="form-control" id="phone_number" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                        <label for="phone_number">Phone Number</label>
                        @error('phone')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
                        <label for="address">Address</label>
                        @error('address')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="form-floating">
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old('country') }}" required>
                        <label for="country">Country</label>
                        @error('country')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Company -->
                    <div class="form-floating">
                        <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="{{ old('company') }}" required>
                        <label for="company">Company</label>
                        @error('company')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Agree to Terms -->
                    <div class="d-flex justify-content-between mt-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label for="terms" class="form-check-label">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                            @error('terms')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary">Create an account</button>
                    </div>

                    <!-- Already Registered -->
                    <div class="mb-2">Already a member? <a href="{{ route('login') }}">Log in</a></div>

                    <!-- Social Login -->
                    <div class="social-account-wrap">
                        <h4 class="mb-4"><span>or continue with</span></h4>
                        <ul class="list-unstyled social-account d-flex justify-content-between">
                            <li><a href="#"><img src="{{ asset('build/assets/img/icon-google.svg') }}" alt="Google logo"></a></li>
                            <li><a href="#"><img src="{{ asset('build/assets/img/icon-facebook.svg') }}" alt="Facebook logo"></a></li>
                            <li><a href="#"><img src="{{ asset('build/assets/img/icon-apple.svg') }}" alt="Apple logo"></a></li>
                            <li><a href="#"><img src="{{ asset('build/assets/img/icon-twitter.svg') }}" alt="Twitter logo"></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
