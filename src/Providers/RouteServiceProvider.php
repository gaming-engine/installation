<?php

namespace GamingEngine\Installation\Providers;

use GamingEngine\Installation\Http\Controllers\StartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::prefix('install')
            ->name('install.')
            ->group(function () {
                Route::get('/', StartController::class)
                    ->name('index');
            });
    }
}
