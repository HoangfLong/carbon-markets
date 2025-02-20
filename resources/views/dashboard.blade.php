@php
    $hideWelcomeSection = true;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Welcome Message -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h4 card-title text-primary">Welcome back, {{ Auth::user()->name }}!</h3>
                        <p class="card-text text-muted">Here's a quick overview of your account and activities.</p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="col-12 col-md-8 mb-4">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Card 1: Account Info -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Account Information</h5>
                                <ul class="list-unstyled text-muted">
                                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                    <li><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</li>
                                    <li><strong>Last Login:</strong> {{ now()->format('M d, Y H:i') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Recent Activities -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activities</h5>
                                <ul class="list-unstyled text-muted">
                                    <li>- You updated your profile settings.</li>
                                    <li>- Logged in 2 hours ago.</li>
                                    <li>- Purchased a premium package.</li>
                                </ul>
                                <a href="#" class="btn-link text-primary">View All Activities &rarr;</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Notifications -->
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Notifications</h5>
                                <ul class="list-unstyled text-muted">
                                    <li>- You have 3 unread messages.</li>
                                    <li>- Subscription renewal due in 7 days.</li>
                                    <li>- New feature: Dark mode available.</li>
                                </ul>
                                <a href="#" class="btn-link text-primary">Manage Notifications &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Quick Actions</h5>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                            {{-- <div class="col">
                                <a href="{{ route('profile.edit') }}">
                                    <button class="btn btn-outline-primary w-100 bi bi-person-fill">Update Profile</button>
                                </a>
                            </div> --}}
                            <div class="col">
                                <a href="{{ route('orders.index') }}" >
                                    <button class="btn btn-outline-info w-100 bi bi-list-ul">View Orders</button>
                                </a>
                            </div>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <div class="col">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <button class="btn btn-outline-success w-100 bi bi-file-earmark-bar-graph">View Reports</button>
                                    </a>
                                </div>
                            @endif
                            <div class="col">
                                <a href="{{ route('profile.edit') }}" >
                                    <button class="btn btn-outline-warning w-100 bi bi-gear-fill">Settings</button>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    @csrf
                                    <button class="btn btn-outline-danger w-100 bi bi-box-arrow-right">Log Out</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
