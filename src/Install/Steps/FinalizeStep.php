<?php

namespace GamingEngine\Installation\Install\Steps;

use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Steps\BaseStep;
use GamingEngine\Installation\Steps\StepCollection;
use Illuminate\Support\Collection;

class FinalizeStep extends BaseStep
{
    public function __construct(private UpdatesEnvironment $configuration, private StepCollection $steps)
    {
    }

    public function identifier(): string
    {
        return 'finalize';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.finalize.title');
    }

    /**
     * @inheritDoc
     */
    public function checks(): Collection
    {
        return collect();
    }

    public function isComplete(): bool
    {
        return 0 === $this->steps->all()
                ->filter(fn ($step) => ! $step->isComplete())
                ->count();
    }

    public function apply(): void
    {
        $this->configuration->update([
            'GAMING_ENGINE_INSTALLED' => true,
        ], 'finalize');
    }
}
