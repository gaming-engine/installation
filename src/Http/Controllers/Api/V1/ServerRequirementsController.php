<?php

namespace GamingEngine\Installation\Http\Controllers\Api\V1;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Steps\Requirement;
use GamingEngine\Installation\Steps\ServerRequirementsStep;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class ServerRequirementsController extends Controller
{
    private ServerRequirementsStep $step;

    public function __construct(ServerRequirementsStep $step)
    {
        $this->step = $step;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return RequirementResource::collection(
            $this->step->checks()
            ->keyBy(fn (Requirement $requirement) => $requirement->identifier())
        );
    }
}
