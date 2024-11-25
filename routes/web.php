<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
// });

// Route::middleware(['auth', 'permission:create projects'])->group(function () {
//     Route::get('/create-projects', [UserController::class, 'admin']);
// });

require __DIR__.'/auth.php';
