<?php

namespace GamingEngine\Installation\Server\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Server\Http\Resources\Api\V1\ServerRequirementResource;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ServerRequirementsController extends Controller
{
    private ServerRequirementsStep $step;

    public function __construct(ServerRequirementsStep $step)
    {
        $this->step = $step;
    }

    public function index(): ServerRequirementResource
    {
        return new ServerRequirementResource($this->step);
    }

    public function apply(): Response
    {
        try {
            $this->step->apply();

            return response()->noContent();
        } catch (Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
