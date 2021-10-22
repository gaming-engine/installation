<?php

namespace GamingEngine\Installation\Account\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Account\Http\Requests\Api\V1\OverrideRequest;
use GamingEngine\Installation\Account\Http\Resources\Api\V1\AccountDetailsResource;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AccountDetailsController extends Controller
{
    private AccountDetailsStep $step;

    public function __construct(AccountDetailsStep $step)
    {
        $this->step = $step;
    }

    public function index(): AccountDetailsResource
    {
        return new AccountDetailsResource($this->step);
    }

    public function store(OverrideRequest $request): AccountDetailsResource
    {
        $this->step->override(
            $request->validated()
        );

        return new AccountDetailsResource($this->step);
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
