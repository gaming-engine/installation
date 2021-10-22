<?php

namespace GamingEngine\Installation\Database\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Database\Http\Requests\Api\V1\OverrideRequest;
use GamingEngine\Installation\Database\Http\Resources\Api\V1\DatabaseRequirementResource;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DatabaseRequirementsController extends Controller
{
    private DatabaseRequirementsStep $step;

    public function __construct(DatabaseRequirementsStep $step)
    {
        $this->step = $step;
    }

    public function index(): DatabaseRequirementResource
    {
        return new DatabaseRequirementResource($this->step);
    }

    public function store(OverrideRequest $request): DatabaseRequirementResource
    {
        $this->step->override(
            $request->validated()
        );

        return new DatabaseRequirementResource($this->step);
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
