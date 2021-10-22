<?php

namespace GamingEngine\Installation\Requirements\Configuration;

use GamingEngine\Installation\Requirements\RequirementDetail;
use InvalidArgumentException;

abstract class EnvironmentConfigurationValue implements RequirementDetail
{
    protected string $attribute;
    protected string $configurationKey;
    protected string $environmentVariable;
    protected bool $nullable;
    private ?string $override;

    public function __construct(array $arguments)
    {
        $this->attribute = $arguments['attribute'];
        $this->configurationKey = $arguments['configurationKey'];
        $this->environmentVariable = $arguments['environmentVariable'];
        $this->nullable = $arguments['nullable'] ?? false;
    }

    public function attribute(): string
    {
        return $this->attribute;
    }

    public function environmentVariable(): string
    {
        return $this->environmentVariable;
    }

    abstract public function description(): string;

    public function key(): string
    {
        return $this->configurationKey;
    }

    public function check(): bool
    {
        if ($this->nullable() && empty($this->value())) {
            return true;
        }

        return ! empty($this->value());
    }

    public function nullable(): bool
    {
        return $this->nullable;
    }

    public function value(): ?string
    {
        if (isset($this->override)) {
            return $this->override;
        }

        return config("gaming-engine-installation.$this->configurationKey");
    }

    public function override(?string $value): void
    {
        if (! $this->nullable() && empty($value)) {
            throw new InvalidArgumentException($this->name());
        }

        $this->override = $value;
    }

    abstract public function name(): string;
}
