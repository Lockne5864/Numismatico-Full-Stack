<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MoneyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CollectionController;

// Public account endpoints.
Route::prefix('login')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/forgotpassword', [UserController::class, 'forgotpassword']);
    Route::post('/resetpassword', [UserController::class, 'resetpassword']);
});

// Private user and collection data require an authenticated Sanctum bearer token.
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/login/logout', [UserController::class, 'logout']);
    Route::get('/login/check-auth', [UserController::class, 'checkAuth']);

    Route::get('/collection/{userId}/all', [CollectionController::class, 'index']);
    Route::post('/collection/{userId}/add', [CollectionController::class, 'store']);
    Route::get('/collection/{userId}/{collectionId}', [CollectionController::class, 'show']);
    Route::post('/collection/{userId}/{collectionId}/edit', [CollectionController::class, 'edit']);

    Route::get('/{userId}', [MoneyController::class, 'show'])->whereNumber('userId');
    Route::post('/', [MoneyController::class, 'store']);
    Route::post('/{cedulaId}', [MoneyController::class, 'changeToMarcketplace'])->whereNumber('cedulaId');
});

// Public marketplace listing; intentionally returns only items marked for sale.
Route::get('/', [MoneyController::class, 'index']);
