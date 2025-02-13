@extends('layouts.user.app')

@section('content')
    <!-- Kiểm tra trạng thái đăng nhập -->
    @auth
        <!-- Hiển thị thông tin người dùng đã đăng nhập -->
        <div class="flex items-center">
            <span class="text-gray-800">{{ Auth::user()->name }}</span>
            <x-icon-user class="ml-2 w-6 h-6 text-indigo-600" /> <!-- Thêm icon người dùng -->
            <a href="{{ route('logout') }}" class="ml-4 text-sm text-gray-600 hover:text-gray-900">
                {{ __('Log out') }}
            </a>
        </div>
    @else
        <!-- Giao diện Form đăng nhập tùy chỉnh -->
        <div class="site-wrap d-md-flex align-items-stretch">
            <div class="bg-img" style="background-image: url({{ asset('build/assets/img/img-bg-1.jpg') }}">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div class="text-overlay">
                    <h1 class="title">The fight against climate change is in your hands. Take action with us.</h1>
                </div>
            </div>
            <div class="form-wrap">
                <div class="form-inner">
                    <h1 class="title">Login</h1>
                    <p class="caption mb-4">Please enter your login details to sign in.</p>

                    <!-- Form đăng nhập -->
                    <form method="POST" action="{{ route('login') }}" class="pt-3">
                        @csrf
                        <!-- Email -->
                        <div class="form-floating">
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                placeholder="info@example.com" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="username">
                            <label for="email">Email Address</label>
                            @error('email')
                                <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-floating">
                            <span class="js-password-show-toggle">
                                <span class="uil"></span>
                            </span>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Password" 
                                required 
                                autocomplete="current-password">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me + Forgot Password -->
                        <div class="d-flex justify-content-between">
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="remember_me" 
                                    name="remember">
                                <label for="remember_me" class="form-check-label">Keep me logged in</label>
                            </div>
                            <div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </div>

                        <!-- Register Link -->
                        <div class="mb-2">
                            Don’t have an account? 
                            <a href="{{ route('register') }}">Sign up</a>
                        </div>

                        <!-- Social Media Login -->
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
    @endauth
@endsection
