<?php

namespace GamingEngine\Installation\Steps;

use Illuminate\Support\Collection;

class StepCollection
{
    /**
     * @var Collection<Step>
     */
    private Collection $steps;

    /**
     * @param Step[] $steps
     */
    public function __construct(array $steps)
    {
        $this->steps = collect($steps);
    }

    public function next(): ?Step
    {
        return $this->steps->first(
            fn (Step $step) => ! $step->isComplete()
        );
    }

    public function count(): int
    {
        return $this->steps->count();
    }

    /**
     * @return Collection<Step>
     */
    public function all(): Collection
    {
        return $this->steps;
    }
}
