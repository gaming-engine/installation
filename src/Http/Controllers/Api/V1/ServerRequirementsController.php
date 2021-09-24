<?php

namespace GamingEngine\Installation\Http\Controllers\Api\V1;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ServerRequirementResource;
use GamingEngine\Installation\Steps\ServerRequirementsStep;
use Illuminate\Routing\Controller;

class ServerRequirementsController extends Controller
{
    private ServerRequirementsStep $step;

    public function __construct(ServerRequirementsStep $step)
    {
        $this->step = $step;
    }

    public function __invoke(): ServerRequirementResource
    {
        return new ServerRequirementResource($this->step);
    }
}
