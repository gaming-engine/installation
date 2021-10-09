<?php

use GamingEngine\Installation\Account\Http\Api\V1\Controllers\AccountDetailsController;
use GamingEngine\Installation\Database\Http\Api\V1\Controllers\DatabaseRequirementsController;
use GamingEngine\Installation\Http\Controllers\Api\V1\StepController;
use GamingEngine\Installation\Server\Http\Api\V1\Controllers\ServerRequirementsController;
use GamingEngine\Installation\Settings\Http\Api\V1\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('steps', StepController::class)
    ->name('steps');

Route::prefix('server')
    ->name('server.')
    ->group(function () {
        Route::get('requirements', ServerRequirementsController::class)
            ->name('requirements');
    });

Route::prefix('database')
    ->name('database.')
    ->group(function () {
        Route::get('requirements', [DatabaseRequirementsController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [DatabaseRequirementsController::class, 'store'])
            ->name('requirements.update');
    });

Route::prefix('account')
    ->name('account.')
    ->group(function () {
        Route::get('requirements', [AccountDetailsController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [AccountDetailsController::class, 'store'])
            ->name('requirements.update');
    });

Route::prefix('language')
    ->name('language.')
    ->group(function () {
        Route::get('requirements', [LanguageController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [LanguageController::class, 'store'])
            ->name('requirements.update');
    });
