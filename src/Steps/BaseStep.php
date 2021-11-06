<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use Illuminate\Support\Collection;

abstract class BaseStep implements Step
{
    abstract public function identifier(): string;

    abstract public function title(): string;

    public function isComplete(): bool
    {
        return $this->checks()
                ->first(
                    fn (Requirement $requirement) => ! $requirement->check()
                ) === null;
    }

    public function flatten(): Collection
    {
        return $this->checks()
            ->map(fn (Requirement $requirement) => $requirement->components())
            ->flatten();
    }
}
