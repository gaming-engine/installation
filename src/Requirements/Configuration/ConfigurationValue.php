<?php

namespace GamingEngine\Installation\Requirements\Configuration;

use GamingEngine\Installation\Requirements\RequirementDetail;
use InvalidArgumentException;

abstract class ConfigurationValue implements RequirementDetail
{
    protected string $attribute;
    protected ?string $value;
    protected bool $nullable;
    private ?string $override;

    public function __construct(array $arguments)
    {
        $this->attribute = $arguments['attribute'];
        $this->value = $arguments['value'] ?? null;
        $this->nullable = $arguments['nullable'] ?? false;
    }

    public function attribute(): string
    {
        return $this->attribute;
    }

    abstract public function description(): string;

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

        return $this->value;
    }

    public function override(?string $value): void
    {
        if (! $this->nullable() && empty($value)) {
            throw new InvalidArgumentException($this->title());
        }

        $this->override = $value;
    }

    abstract public function title(): string;
}
