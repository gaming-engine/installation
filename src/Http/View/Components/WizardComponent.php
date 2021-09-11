<?php

namespace GamingEngine\Installation\Http\View\Components;

use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\StepCollection;
use Illuminate\View\Component;

class WizardComponent extends Component
{
    public StepCollection $stepCollection;

    public function __construct(StepCollection $stepCollection)
    {
        $this->stepCollection = $stepCollection;
    }

    public function render()
    {
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
