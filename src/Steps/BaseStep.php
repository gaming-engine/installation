<?php

namespace GamingEngine\Installation\Steps;

abstract class BaseStep implements Step
{
    abstract public function identifier(): string;

    abstract public function name(): string;

    public function isComplete(): bool
    {
        return $this->checks()
                ->first(
                    fn (Requirement $requirement) => ! $requirement->check()
                ) === null;
    }
}
