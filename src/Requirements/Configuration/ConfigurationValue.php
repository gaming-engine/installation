<?php

namespace GamingEngine\Installation\Requirements\Configuration;

use GamingEngine\Installation\Requirements\RequirementDetail;
use JetBrains\PhpStorm\ArrayShape;

abstract class ConfigurationValue implements RequirementDetail
{
    protected string $attribute;
    protected string $configurationKey;
    protected string $environmentVariable;
    protected bool $nullable;

    #[ArrayShape([
        'attribute' => 'string',
        'configurationKey' => 'string',
        'environmentVariable' => 'string',
        'nullable' => '?boolean',
    ])]
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

    public function environmentVariable()
    {
        return $this->environmentVariable;
    }

    abstract public function name(): string;

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
        return config("gaming-engine-installation.$this->configurationKey");
    }
}
