<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
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

    /**
     * @return Collection<RequirementDetail>
     */
    public function flatten(): Collection;

    public function apply(): void;
}
