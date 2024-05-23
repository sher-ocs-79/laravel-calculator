<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/evaluate', [\App\Http\Controllers\MathController::class, 'evaluate']);
