<?php

namespace GamingEngine\Installation\Requirements\Account;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;

class AccountConfigurationValue extends ConfigurationValue
{
    public function name(): string
    {
        return __("gaming-engine:installation::requirements.account.configuration.{$this->attribute}.name");
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.account.configuration.{$this->attribute}.description");
    }
}
