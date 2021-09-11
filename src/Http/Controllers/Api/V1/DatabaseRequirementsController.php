<?php

namespace GamingEngine\Installation\Http\Controllers\Api\V1;

use GamingEngine\Installation\Http\Requests\Api\V1\DatabaseRequirements\OverrideRequest;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\DatabaseRequirementResource;
use GamingEngine\Installation\Steps\DatabaseRequirementsStep;
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
}
