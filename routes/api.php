<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

// Auth routes (public)
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::post('/client/login', [AuthController::class, 'clientLogin']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Common authenticated routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Admin routes - full CRUD for clients
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/clients', [AdminController::class, 'index']);
        Route::post('/admin/clients', [AdminController::class, 'store']);
        Route::get('/admin/clients/{id}', [AdminController::class, 'show']);
        Route::put('/admin/clients/{id}', [AdminController::class, 'update']);
        Route::delete('/admin/clients/{id}', [AdminController::class, 'destroy']);
    });

    // Client routes - read-only
    Route::middleware('role:client')->group(function () {
        Route::get('/clients', [ClientController::class, 'index']);
        Route::get('/clients/{id}', [ClientController::class, 'show']);
    });
});
