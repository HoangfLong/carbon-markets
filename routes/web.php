<?php

use App\Http\Controllers\CarbonCreditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarbonProject;
use App\Http\Controllers\CarbonProjectController;
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

    //Carbon registry route
    Route::get('/carbon-credits',[CarbonCreditController::class,'index'])->name('carbon-credits.index');

    Route::get('/carbon-credits/create',[CarbonCreditController::class,'create'])->name('carbon-credits.create');

    Route::post('/carbon-credits',[CarbonCreditController::class,'store'])->name('carbon-credits.store');

    Route::get('/carbon-credits/edit/{id}',[CarbonCreditController::class,'edit'])->name('carbon-credits.edit');

    Route::put('/carbon-credits/{id}',[CarbonCreditController::class,'update'])->name('carbon-credits.update');

    Route::delete('/carbon-credits/{id}',[CarbonCreditController::class,'destroy'])->name('carbon-credits.destroy');
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


 //Carbon project route
 Route::get('/',[HomeController::class,'home'])->name('carbon-credits.home');

 Route::get('/marketplace',[HomeController::class,'market'])->name('carbon-credits.market');

 Route::get('/carbon-projects',[CarbonProjectController::class,'index'])->name('carbon-projects.index');

 Route::get('/carbon-projects/{carbonProject}',[CarbonProjectController::class,'show'])->name('carbon-projects.show');

 Route::get('/carbon-projects/create',[CarbonProjectController::class,'create'])->name('carbon-projects.create');

 Route::post('/carbon-projects',[CarbonProjectController::class,'store'])->name('carbon-projects.store');

 Route::get('/carbon-projects/edit/{carbonProject}',[CarbonProjectController::class,'edit'])->name('carbon-projects.edit');

 Route::put('/carbon-projects/{carbonProject}',[CarbonProjectController::class,'update'])->name('carbon-projects.update');

 Route::delete('/carbon-projects/{carbonProject}',[CarbonProjectController::class,'destroy'])->name('carbon-projects.destroy');

require __DIR__.'/auth.php';
