<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('log-in', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

    // Profile
    Route::get('/profile', [UserController::class, 'profile']);

    // User Management
    Route::get('/users', [UserController::class, 'index'])->middleware('can:admin');
    Route::get('/find-user-has-no-role', [UserController::class, 'findUser'])->middleware('can:admin');
    Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->middleware('can:admin');

    // Articles
    Route::get('/articles', [ArticleController::class, 'index'])->middleware('can:viewAny,' . Article::class);

    Route::get('/articles/mine', [ArticleController::class, 'mine'])->middleware('can:viewAny,' . Article::class);

    Route::post('/articles', [ArticleController::class, 'store'])->middleware('can:create,' . Article::class);

    Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware('can:update,article');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware('can:delete,article');

    Route::patch('/articles/{article}/publish', [ArticleController::class, 'publish'])->middleware('can:publish,article');
});
