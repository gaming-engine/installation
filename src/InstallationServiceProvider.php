<?php

namespace GamingEngine\Installation;

use GamingEngine\Core\Core;
use GamingEngine\Core\Framework\Environment\Environment;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\DatabaseConnection;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Helpers\PHP\PHPDetails;
use GamingEngine\Installation\Helpers\PHP\PHPFeatureInformation;
use GamingEngine\Installation\Http\View\Components\WizardComponent;
use GamingEngine\Installation\Module\InstallationModule;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use GamingEngine\Installation\Steps\StepCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InstallationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->app->singleton(
            PHPFeatureInformation::class,
            PHPDetails::class
        );

        Blade::component('ge:l-wizard', WizardComponent::class);

        $this->app->singleton(
            ChecksDatabaseConnection::class,
            fn () => app(DatabaseConnection::class)
        );

        $package
            ->name('gaming-engine:installation')
            ->hasConfigFile('gaming-engine-installation')
            ->hasViews();

        $this->loadInstallationSteps();

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);

        $this->publishAssets();
        $this->publishLanguages();
    }

    private function loadInstallationSteps()
    {
        $this->app->singleton(
            StepCollection::class,
            fn () => new StepCollection([
                app(LanguageSettingsStep::class),
                new ServerRequirementsStep(),
                app(DatabaseRequirementsStep::class),
                new AccountDetailsStep(),
            ])
        );
    }

    private function publishAssets(): void
    {
        $environment = $this->environment();

        $this->publishes([
            __DIR__ . "/../dist/$environment/" => 'public/modules/installation/',
        ], 'gaming-engine:installation-resources');
    }

    private function environment(): string
    {
        return app(Environment::class)->name();
    }

    private function publishLanguages(): void
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'gaming-engine:installation'
        );
    }

    public function packageBooted(): void
    {
        /**
         * @var $core Core
         */
        $core = app(Core::class);

        $core->registerPackage(app(InstallationModule::class));
        $this->setLanguage();
    }

    private function setLanguage(): void
    {
        /**
         * @var LanguageSettingsStep $language
         */
        $language = app(LanguageSettingsStep::class);
        App::setLocale($language->locale());
    }
}
