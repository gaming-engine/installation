<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Collection;

interface Step
{
    public function identifier(): string;

    public function name(): string;

    public function isComplete(): bool;

    /**
     * @return Collection<Requirement>
     */
    public function checks(): Collection;
}
