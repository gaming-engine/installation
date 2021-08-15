<?php

namespace GamingEngine\Installation\Http\Controllers;

use Illuminate\Routing\Controller;

class StartController extends Controller
{
    public function __invoke()
    {
        return 'installer';
    }
}
