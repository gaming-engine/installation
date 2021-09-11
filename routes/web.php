<?php

use GamingEngine\Installation\Http\Controllers\StartController;
use Illuminate\Support\Facades\Route;

Route::get('/', StartController::class)
    ->name('index');
