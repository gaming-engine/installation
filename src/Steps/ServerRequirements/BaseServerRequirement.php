<?php

namespace GamingEngine\Installation\Steps\ServerRequirements;

use GamingEngine\Installation\Steps\Requirement;
use GamingEngine\Installation\Steps\RequirementDetail;
use Illuminate\Support\Collection;

abstract class BaseServerRequirement implements Requirement
{
    abstract public function name(): string;

    public function check(): bool
    {
        return $this->components()
                ->first(fn (RequirementDetail $details) => ! $details->check()) === null;
    }

    /**
     * @return Collection<RequirementDetail>
     */
    public function components(): Collection
    {
        return collect($this->checks());
    }

    /**
     * @return RequirementDetail[]
     */
    abstract protected function checks(): array;
}
