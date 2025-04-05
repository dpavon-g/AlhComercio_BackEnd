<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/getNegocios', [APIsController::class, 'getNegocios']);
});

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

// Route::post('/createUser', [UsersController::class, 'createUser']);
// Route::post('/checkLogin', [UsersController::class, 'checkLogin']);