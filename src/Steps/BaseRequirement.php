<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Collection;

abstract class BaseRequirement implements Requirement
{
    abstract public function name(): string;

    abstract public function description(): string;

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $detail) => ! $detail->check()) === null;
    }

    /**
     * @inheritDoc
     */
    abstract public function components(): Collection;
}
