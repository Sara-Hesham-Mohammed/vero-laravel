<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::apiResource('users', UserController::class);


Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
Route::post('/login', [UserController::class, 'login'])->name('login');