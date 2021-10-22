<?php

namespace GamingEngine\Installation\Settings\Steps;

use GamingEngine\Installation\Install\UpdatesConfiguration;
use GamingEngine\Installation\Settings\Requirements\LanguageConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class LanguageSettingsStep extends BaseConfigurationStep
{
    private UpdatesConfiguration $configuration;

    public function __construct(UpdatesConfiguration $configuration)
    {
        parent::__construct();
        $this->configuration = $configuration;
    }

    public function identifier(): string
    {
        return 'language';
    }

    public function name(): string
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
    }
}
