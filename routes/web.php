<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\EmailVerificationController;

// Show email verification notice
Route::get('/email/verify/notice', [EmailVerificationController::class, 'showNotice'])->name('verification.notice');

// Email verification confirmation
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

// Resend email verification link
Route::post('/email/verify/resend', [EmailVerificationController::class, 'resend'])->middleware(['auth'])->name('verification.send');
Route::get('/web/email/verify/resend/{uid}', [EmailVerificationController::class, 'resendW'])->name('resendVerify');

Route::group(['middleware' => 'auth'],function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/user/{id}', [UserController::class, 'updateUser'])->name('editUser');
    Route::put('/user/{id}/data', [UserDataController::class, 'update'])->name('editUserData');
    Route::get('/logout', [UserController::class, 'logOut'])->name('logout');
});
Route::middleware('guest')->group(function(){
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginFunc'])->name('loginFunc');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register',  [UserController::class, 'create'])->name('createUser');
});

Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/web/email/verify/resend/{uid}', [EmailVerificationController::class, 'resendW'])->name('resendVerify');
Route::get('/chat', function(){
    $user = Auth::user()->load('user_data');

    return view('chat',compact('user'));
});
