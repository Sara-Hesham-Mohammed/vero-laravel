<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;


// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home')
// ->middleware('verified');

// //login with any service facebook, github, whatever
// Route::get('/{service}/login', [SocialController::class, 'redirect']);
// Route::get('/callback/{service}', [SocialController::class, 'callback']);

Route::get('/', function () {
    return "view('welcome')";
})->name('home');
