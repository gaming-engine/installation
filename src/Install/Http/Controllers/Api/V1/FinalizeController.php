<?php

namespace GamingEngine\Installation\Install\Http\Controllers\Api\V1;

use GamingEngine\Installation\Install\Steps\FinalizeStep;
use Illuminate\Routing\Controller;

class FinalizeController extends Controller
{
    public function __construct(private FinalizeStep $step)
    {
    }

    public function index()
    {
        return [
            'resources' => __('gaming-engine:installation::requirements.finalize'),
        ];
    }

    public function apply()
    {
        $this->step->apply();
    }
}
