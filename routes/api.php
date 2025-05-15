<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegociosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/getNegocios', [NegociosController::class, 'getNegocios']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/createNegocio', [NegociosController::class, 'createNegocio']);
});

Route::post('register', [JWTAuthController::class, 'register']);
Route::get('getUser', [JWTAuthController::class, 'getUser']);
Route::post('logout', [JWTAuthController::class, 'logout']);
Route::post('login', [JWTAuthController::class, 'login']);

// Route::post('/createUser', [UsersController::class, 'createUser']);
// Route::post('/checkLogin', [UsersController::class, 'checkLogin']);