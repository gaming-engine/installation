<?php

namespace GamingEngine\Installation\Database\Requirements;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;

class DatabaseConfigurationValue extends EnvironmentConfigurationValue
{
    public function name(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.name");
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.description");
    }
}
