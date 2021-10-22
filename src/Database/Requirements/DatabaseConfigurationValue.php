<?php

namespace GamingEngine\Installation\Database\Requirements;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;

class DatabaseConfigurationValue extends EnvironmentConfigurationValue
{
    public function name(): string
    {
        return (string)__("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.description");
    }
}
