<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailVerificationController;

// Show email verification notice
Route::get('/email/verify/notice', [EmailVerificationController::class, 'showNotice'])->name('verification.notice');

// Email verification confirmation
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

// Resend email verification link
Route::post('/email/verify/resend', [EmailVerificationController::class, 'resend'])->middleware(['auth'])->name('verification.send');

Route::group(['middleware' => 'auth'],function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/user/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::put('/user/{id}/data', [UserController::class, 'editUserData'])->name('editUserData');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginFunc'])->name('loginFunc');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register',  [UserController::class, 'create'])->name('createUser');
Route::get('/logout', [UserController::class, 'logOut'])->name('logout');

