<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegociosController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/getNegocios', [NegociosController::class, 'getNegocios']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/createNegocio', [NegociosController::class, 'createNegocio']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::delete('/eliminarNegocio', [NegociosController::class, 'deleteNegocio']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/getNegocioByID', [NegociosController::class, 'getNegocioByID']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/createOferta', [OfertasController::class, 'createOferta']);
});

Route::post('register', [JWTAuthController::class, 'register']);
Route::get('getUser', [JWTAuthController::class, 'getUser']);
Route::post('logout', [JWTAuthController::class, 'logout']);
Route::post('login', [JWTAuthController::class, 'login']);