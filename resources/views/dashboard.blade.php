@php
    $hideWelcomeSection = true;
@endphp

@extends('layouts.app')

@section('content')
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Here's a quick overview of your account and activities.</p>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Account Info -->
                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Account Information</h4>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li><strong>Member Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</li>
                        <li><strong>Last Login:</strong> {{ now()->format('M d, Y H:i') }}</li>
                    </ul>
                </div>

                <!-- Card 2: Recent Activities -->
                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Recent Activities</h4>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li>- You updated your profile settings.</li>
                        <li>- Logged in 2 hours ago.</li>
                        <li>- Purchased a premium package.</li>
                    </ul>
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 mt-3 block">View All Activities &rarr;</a>
                </div>

                <!-- Card 3: Notifications -->
                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Notifications</h4>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li>- You have 3 unread messages.</li>
                        <li>- Subscription renewal due in 7 days.</li>
                        <li>- New feature: Dark mode available.</li>
                    </ul>
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 mt-3 block">Manage Notifications &rarr;</a>
                </div>
            </div>

            <!-- Additional Section -->
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6 mt-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Quick Actions</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#" class="p-4 bg-indigo-600 text-white rounded-lg text-center shadow-md hover:bg-indigo-500">
                        Update Profile
                    </a>
                    <a href="#" class="p-4 bg-green-600 text-white rounded-lg text-center shadow-md hover:bg-green-500">
                        View Reports
                    </a>
                    <a href="#" class="p-4 bg-yellow-600 text-white rounded-lg text-center shadow-md hover:bg-yellow-500">
                        Settings
                    </a>
                    <a href="#" class="p-4 bg-red-600 text-white rounded-lg text-center shadow-md hover:bg-red-500">
                        Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
