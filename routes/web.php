<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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
    //Project route
    Route::resource('/projects', ProjectController::class);
    //Credit route
    Route::resource('/credits', CreditController::class);
    //Payment
    Route::get('payment/{carbonProjectId}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('payment/{carbonProjectId}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('payment/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');



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

//Home
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/marketplace', [HomeController::class, 'market'])->name('carbon-projects.marketplace');




require __DIR__ . '/auth.php';
