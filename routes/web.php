<?php

use App\Http\Controllers\ArrosageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\FertilisationController;
use App\Http\Controllers\ParcelleController;
use App\Http\Controllers\RecolteController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SemisController;
use App\Http\Controllers\TypeCultureController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(
    function () {
        Route::get('/', [AuthController::class, 'index'])->name('index');
        Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/forgot-password', [ResetPasswordController::class, 'passwordRequest'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
    }
);

Route::middleware('auth')->group(
    function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('verified')->name('dashboard');
        Route::get('/globalStats', [AuthController::class, 'stream'])->middleware('verified')->name('stats.global');
        Route::get('/profile', [UserController::class, 'profile'])->middleware('verified')->name('profile');
        Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
        Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');
    }
);
Route::middleware(['auth', CheckRole::class . ':admin', 'verified'])->group(
    function () {
        Route::resource('culture', CultureController::class);
        Route::resource('type-culture', TypeCultureController::class);
        Route::resource('user', UserController::class);
    }
);

Route::middleware(['auth', CheckRole::class . ':agriculteur', 'verified'])->group(
    function () {
        Route::resource('parcelle', ParcelleController::class);
        Route::resource('semis', SemisController::class);
        Route::resource('recolte', RecolteController::class);
        Route::resource('fertilisation', FertilisationController::class);
        Route::resource('arrosage', ArrosageController::class);
    }
);
