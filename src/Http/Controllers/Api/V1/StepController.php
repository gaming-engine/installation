<?php

namespace GamingEngine\Installation\Http\Controllers\Api\V1;

use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\StepCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class StepController extends Controller
{
    private StepCollection $stepCollection;

    public function __construct(StepCollection $stepCollection)
    {
        $this->stepCollection = $stepCollection;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return StepResource::collection(
            $this->stepCollection->all()
        );
    }
}
