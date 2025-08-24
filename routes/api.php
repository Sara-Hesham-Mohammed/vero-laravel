<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::apiResource('users', UserController::class);
Route::prefix('users')->group(function () {
    Route::post('/{id}/assign-role', [UserController::class, 'assign_role']);
    Route::post('/{id}/get-roles', [UserController::class, 'get_roles']);
    Route::post('/{id}/get-permissions', [UserController::class, 'get_permissions']);
});

Route::apiResource('permissions', PermissionController::class);

Route::apiResource('roles', RoleController::class);
Route::prefix('roles')->group(function () {
    Route::post('/{role}/assign-permissions', [RoleController::class, 'assign_permission']);
});


Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
Route::post('/login', [UserController::class, 'login'])->name('login');