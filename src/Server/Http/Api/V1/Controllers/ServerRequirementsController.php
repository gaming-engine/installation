<?php

namespace GamingEngine\Installation\Server\Http\Api\V1\Controllers;

use GamingEngine\Installation\Server\Http\Api\V1\Resources\ServerRequirementResource;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
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
