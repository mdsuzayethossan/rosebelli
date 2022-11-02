<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPasswordResetController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

//Admin Auth
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'login_create'])->middleware('guest:admin');
    Route::post('login', [AdminController::class, 'login_store'])->middleware('guest:admin')->name('admin.login');
    Route::get('forgot-password', [AdminPasswordResetController::class, 'showForm'])
        ->name('admin.password.request');
    Route::post('forgot-password', [AdminPasswordResetController::class, 'submitForm'])
        ->name('admin.password.email');

    Route::get('password/reset/form/{token}', [AdminPasswordResetController::class, 'create'])
        ->name('admin.password.reset');

    Route::post('reset-password', [AdminPasswordResetController::class, 'store'])
        ->name('admin.password.update');
    Route::middleware('admin')->group(function () {
        Route::get('register', [AdminController::class, 'create']);
        Route::post('register', [AdminController::class, 'store'])->name('admin.register');
        Route::post('logout', [AdminController::class, 'admin_destroy'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
    });
});
