<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIsController;

Route::get('/getEstablecimientos', [APIsController::class, 'getEstablecimientos']);