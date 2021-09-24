<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Collection;

class SettingsStep extends BaseStep
{
    public function identifier(): string
    {
        return 'settings';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.settings.name');
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect();
    }
}
