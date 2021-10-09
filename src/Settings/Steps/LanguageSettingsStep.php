<?php

namespace GamingEngine\Installation\Settings\Steps;

use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class LanguageSettingsStep extends BaseConfigurationStep
{
    public function identifier(): string
    {
        return 'language';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.settings.language.name');
    }

    public function locale(): string
    {
        return $this->checks()
            ->first()
            ->components()
            ->first()
            ->value();
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
}
