<?php

namespace GamingEngine\Installation\Account\Http\Api\V1\Controllers;

use GamingEngine\Installation\Account\Http\Api\V1\Requests\OverrideRequest;
use GamingEngine\Installation\Account\Http\Api\V1\Resources\AccountDetailsResource;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
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
