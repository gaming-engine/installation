<?php

namespace GamingEngine\Installation;

use GamingEngine\Core\Core;
use GamingEngine\Core\Framework\Environment\Environment;
use GamingEngine\Installation\Module\InstallationModule;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InstallationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('gaming-engine:installer')
            ->hasConfigFile('gaming-engine-installer')
            ->hasViews();

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);

        $this->publishAssets();
        $this->publishLanguages();
    }

    private function publishAssets(): void
    {
        $environment = $this->environment();

        $this->publishes([
            __DIR__ . "/../dist/$environment/public/js/" => 'public/js/installer/',
            __DIR__ . "/../dist/$environment/public/css/" => 'public/css/installer/',
            __DIR__ . '/../resources/images' => 'public/images/installer/',
        ], 'gaming-engine:installer-resources');
    }

    private function environment(): string
    {
        return app(Environment::class)->name();
    }

    public function publishLanguages(): void
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'gaming-engine:installer'
        );
    }

    public function packageBooted(): void
    {
        /**
         * @var $core Core
         */
        $core = app(Core::class);

        $core->registerPackage(app(InstallationModule::class));
    }
}
