<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserController;

// Routes accessible only when user is authenticated
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [CustomAuthController::class, 'profile'])->name('profile');
    Route::post('profile/update', [CustomAuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/pdf', [UserController::class, 'downloadPDF'])->name('users.pdf');
    Route::get('/users/excel', [UserController::class, 'exportExcel'])->name('users.excel');
});

// Routes accessible only when user is not authenticated
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');

    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
});

// Redirect any unauthorized access to login page
Route::fallback(function () {
    return redirect()->route('login');
});
