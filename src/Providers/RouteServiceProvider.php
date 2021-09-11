<?php

namespace GamingEngine\Installation\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api/v1/installation')
                ->name('api.v1.installation')
                ->group(__DIR__ . '/../../routes/api.php');

            Route::middleware('web')
                ->prefix('install')
                ->name('install.')
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }
}
