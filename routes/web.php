<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/getEstablecimientos', [NegociosController::class, 'getEstablecimientos']);

