<?php

namespace GamingEngine\Installation\Settings\Steps;

use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Settings\Requirements\LanguageConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class LanguageSettingsStep extends BaseConfigurationStep
{
    public function __construct(
        private UpdatesEnvironment $configuration,
    ) {
        parent::__construct();
    }

    public function identifier(): string
    {
        return 'language';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.settings.language.title');
    }

    public function locale(): string
    {
        return $this->localeConfiguration()
                ->value() ?? 'en';
    }

    private function localeConfiguration(): LanguageConfigurationValue
    {
        return $this->checks()
            ->first()
            ->components()
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect([
            new LanguageSettings($this->overrides()),
        ]);
    }

    public function apply(): void
    {
        $locale = $this->localeConfiguration();

        $this->configuration->update([
            $locale->environmentVariable() => $locale->value(),
        ], 'language');

        $this->configurationRepository()->update(
            SiteConfiguration::fromConfiguration(
                $this->configurationRepository()->site(),
                [
                    'name' => $locale->value(),
                ]
            )
        );
    }

    private function configurationRepository(): ConfigurationRepository
    {
        return app(ConfigurationRepository::class);
    }
}
