<?php

namespace GamingEngine\Installation\Module;

use GamingEngine\Core\Framework\Module\BaseModule;
use GamingEngine\Core\Framework\Module\Module;

class InstallationModule extends BaseModule implements Module
{
    const PACKAGE = 'gaming-engine:installation';
    const VERSION = '0.0.0';

    public function name(): string
    {
        return self::PACKAGE;
    }

    public function version(): string
    {
        return self::VERSION;
    }
}
