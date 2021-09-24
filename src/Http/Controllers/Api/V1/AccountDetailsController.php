<?php

namespace GamingEngine\Installation\Http\Controllers\Api\V1;

use GamingEngine\Installation\Http\Requests\Api\V1\AccountDetails\OverrideRequest;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\AccountDetailsResource;
use GamingEngine\Installation\Steps\AccountDetailsStep;
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
}
