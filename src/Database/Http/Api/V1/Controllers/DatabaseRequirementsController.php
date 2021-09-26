<?php

namespace GamingEngine\Installation\Database\Http\Api\V1\Controllers;

use GamingEngine\Installation\Database\Http\Api\V1\Requests\OverrideRequest;
use GamingEngine\Installation\Database\Http\Api\V1\Resources\DatabaseRequirementResource;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
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
