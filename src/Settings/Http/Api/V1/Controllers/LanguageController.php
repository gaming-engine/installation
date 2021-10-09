<?php

namespace GamingEngine\Installation\Settings\Http\Api\V1\Controllers;

use GamingEngine\Installation\Settings\Http\Api\V1\Requests\LanguageOverrideRequest;
use GamingEngine\Installation\Settings\Http\Api\V1\Resources\LanguageResource;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use Illuminate\Routing\Controller;

class LanguageController extends Controller
{
    private LanguageSettingsStep $step;

    public function __construct(LanguageSettingsStep $step)
    {
        $this->step = $step;
    }

    public function index(): LanguageResource
    {
        return new LanguageResource($this->step);
    }

    public function store(LanguageOverrideRequest $request): LanguageResource
    {
        $this->step->override(
            $request->validated()
        );

        return new LanguageResource($this->step);
    }
}
