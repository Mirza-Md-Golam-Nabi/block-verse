<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});
