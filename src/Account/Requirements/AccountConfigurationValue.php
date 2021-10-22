<?php

namespace GamingEngine\Installation\Account\Requirements;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;

class AccountConfigurationValue extends ConfigurationValue
{
    public function name(): string
    {
        return __("gaming-engine:installation::requirements.account.configuration.{$this->attribute}.title");
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.account.configuration.{$this->attribute}.description");
    }
}
