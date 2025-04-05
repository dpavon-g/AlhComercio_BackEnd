<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIsController;
use App\Http\Controllers\UsersController;

Route::get('/getNegocios', [APIsController::class, 'getNegocios']);
Route::post('/createUser', [UsersController::class, 'createUser']);
Route::post('/checkLogin', [UsersController::class, 'checkLogin']);