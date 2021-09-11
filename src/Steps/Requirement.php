<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Collection;

interface Requirement
{
    public function identifier(): string;

    public function name(): string;

    public function description(): string;

    public function check(): bool;

    /**
     * @return Collection<RequirementDetail>
     */
    public function components(): Collection;
}
