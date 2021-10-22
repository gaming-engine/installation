<?php

namespace GamingEngine\Installation\Settings\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Settings\Http\Requests\Api\V1\LanguageOverrideRequest;
use GamingEngine\Installation\Settings\Http\Resources\Api\V1\LanguageResource;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use Illuminate\Http\Response;
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

    public function apply(): Response
    {
        try {
            $this->step->apply();

            return response()
                ->noContent();
        } catch (Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
