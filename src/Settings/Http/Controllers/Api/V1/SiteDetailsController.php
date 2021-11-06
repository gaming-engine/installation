<?php

namespace GamingEngine\Installation\Settings\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Settings\Http\Requests\Api\V1\SiteDetailsOverrideRequest;
use GamingEngine\Installation\Settings\Http\Resources\Api\V1\SiteDetailsResource;
use GamingEngine\Installation\Settings\Steps\SiteDetailsStep;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SiteDetailsController extends Controller
{
    public function __construct(private SiteDetailsStep $step)
    {
    }

    public function index(): SiteDetailsResource
    {
        return new SiteDetailsResource($this->step);
    }

    public function store(SiteDetailsOverrideRequest $request): SiteDetailsResource
    {
        $this->step->override(
            $request->validated()
        );

        return new SiteDetailsResource($this->step);
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
