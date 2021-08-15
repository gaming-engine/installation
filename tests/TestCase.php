<?php

namespace GamingEngine\Installation\Tests;

use GamingEngine\Core\CoreServiceProvider;
use GamingEngine\Installation\InstallationServiceProvider;
use GamingEngine\Installation\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => Str::of($modelName)
                    ->replace(
                        'GamingEngine\\Installer\\',
                        'GamingEngine\\Installer\\Database\\Factories\\'
                    )
                    ->replace('\\Models\\', '\\')
                . 'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            InstallationServiceProvider::class,
            RouteServiceProvider::class,
        ];
    }
}
