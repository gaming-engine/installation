<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Requirements\Account\AccountConfigurationRequirements;
use Illuminate\Support\Collection;

class AccountDetailsStep extends BaseConfigurationStep implements Step
{
    public function identifier(): string
    {
        return 'account';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.account.configuration.name');
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect([
            new AccountConfigurationRequirements($this->overrides()),
        ]);
    }
}
