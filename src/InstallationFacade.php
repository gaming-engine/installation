<?php

namespace GamingEngine\Installation;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GamingEngine\Installation\Installation
 * @codeCoverageIgnore
 */
class InstallationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}
