<?php

namespace GamingEngine\Installation\Account\Steps;

use GamingEngine\Installation\Account\Requirements\AccountConfigurationRequirements;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class AccountDetailsStep extends BaseConfigurationStep
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
