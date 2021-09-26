<?php

namespace GamingEngine\Installation\Server\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
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
