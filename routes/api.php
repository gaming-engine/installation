<?php

use GamingEngine\Installation\Account\Http\Controllers\Api\V1\AccountDetailsController;
use GamingEngine\Installation\Database\Http\Controllers\Api\V1\DatabaseRequirementsController;
use GamingEngine\Installation\Http\Controllers\Api\V1\StepController;
use GamingEngine\Installation\Install\Http\Controllers\Api\V1\FinalizeController;
use GamingEngine\Installation\Server\Http\Controllers\Api\V1\ServerRequirementsController;
use GamingEngine\Installation\Settings\Http\Controllers\Api\V1\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('steps', StepController::class)
    ->name('steps');

Route::prefix('account')
    ->name('account.')
    ->group(function () {
        Route::get('requirements', [AccountDetailsController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [AccountDetailsController::class, 'store'])
            ->name('requirements.update');

        Route::put('requirements', [AccountDetailsController::class, 'apply'])
            ->name('requirements.apply');
    });

Route::prefix('database')
    ->name('database.')
    ->group(function () {
        Route::get('requirements', [DatabaseRequirementsController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [DatabaseRequirementsController::class, 'store'])
            ->name('requirements.update');

        Route::put('requirements', [DatabaseRequirementsController::class, 'apply'])
            ->name('requirements.apply');
    });

Route::prefix('finalize')
    ->name('finalize.')
    ->group(function () {
        Route::get('requirements', [FinalizeController::class, 'index'])
            ->name('requirements');

        Route::put('requirements', [FinalizeController::class, 'apply'])
            ->name('requirements.apply');
    });

Route::prefix('language')
    ->name('language.')
    ->group(function () {
        Route::get('requirements', [LanguageController::class, 'index'])
            ->name('requirements');

        Route::post('requirements', [LanguageController::class, 'store'])
            ->name('requirements.update');

        Route::put('requirements', [LanguageController::class, 'apply'])
            ->name('requirements.apply');
    });

Route::prefix('server')
    ->name('server.')
    ->group(function () {
        Route::get('requirements', [ServerRequirementsController::class, 'index'])
            ->name('requirements');

        Route::put('requirements', [ServerRequirementsController::class, 'apply'])
            ->name('requirements.apply');
    });
