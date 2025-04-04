<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeCultureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class,'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard');
Route::get('/profile', [UserController::class,'profile'])->name('profile');

Route::resource('type-culture', TypeCultureController::class);
