<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Payment
    Route::get('project/{carbonProjectId}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('project/{carbonProjectId}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('project/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('project/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});
//Home
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/marketplace', [HomeController::class, 'market'])->name('carbon-projects.marketplace');

require __DIR__ . '/auth.php';
