<?php

namespace GamingEngine\Installation\Http\View\Components;

use Closure;
use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\FullStepCollection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WizardComponent extends Component
{
    public function __construct(public FullStepCollection $stepCollection)
    {
    }

    public function render(
    ): View|Factory|Htmlable|string|Closure|Application {
        return view(
            'gaming-engine:installation::components.wizard',
            [
                'steps' => StepResource::collection(
                    $this->stepCollection->all()
                ),
            ]
        );
    }
}
