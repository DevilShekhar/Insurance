<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignerDashboardController;
use App\Http\Controllers\RoomPackController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InsuranceController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DesignerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('room_packs', RoomPackController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('users', UserController::class);
      Route::resource('insurances', InsuranceController::class);
       Route::get('expire-insurance', [InsuranceController::class, 'expire'])->name('expire-insurance');
         Route::get('re-expire-insurance', [InsuranceController::class, 're_expire'])->name('re-expire-insurance');
         Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
          Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
});
