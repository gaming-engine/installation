<?php

namespace GamingEngine\Installation\Steps\DatabaseRequirements;

use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use InvalidArgumentException;

class DatabaseConfigurationValue extends ConfigurationValue
{
    private ?string $override;

    public function override(?string $value)
    {
        if (! $this->nullable() && empty($value)) {
            throw new InvalidArgumentException($this->name());
        }

        $this->override = $value;
    }

    public function name(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.name");
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.database.configuration.{$this->attribute}.description");
    }

    public function value(): ?string
    {
        if (isset($this->override)) {
            return $this->override;
        }

        return parent::value();
    }
}
