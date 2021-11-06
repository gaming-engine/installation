<?php

namespace GamingEngine\Installation\Requirements;

use Illuminate\Support\Collection;

abstract class BaseRequirement implements Requirement
{
    abstract public function title(): string;

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
