<?php

use GamingEngine\Installation\Http\Controllers\Api\V1\DatabaseRequirementsController;
use GamingEngine\Installation\Http\Controllers\Api\V1\ServerRequirementsController;
use GamingEngine\Installation\Http\Controllers\Api\V1\StepController;
use Illuminate\Support\Facades\Route;

Route::get('steps', StepController::class)
    ->name('steps');
Route::prefix('requirements')
    ->group(function () {
        Route::get('server', ServerRequirementsController::class)
            ->name('server');

        Route::get('database', [DatabaseRequirementsController::class, 'index'])
            ->name('database');

        Route::post('database', [DatabaseRequirementsController::class, 'store'])
            ->name('database.attempt');
    });
