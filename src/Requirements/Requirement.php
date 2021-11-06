<?php

namespace GamingEngine\Installation\Requirements;

use Illuminate\Support\Collection;

interface Requirement
{
    public function identifier(): string;

    public function title(): string;

    public function description(): string;

    public function check(): bool;

    /**
     * @return Collection<RequirementDetail>
     */
    public function components(): Collection;
}
