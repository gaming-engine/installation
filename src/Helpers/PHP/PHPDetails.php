<?php

namespace GamingEngine\Installation\Helpers\PHP;

class PHPDetails implements PHPFeatureInformation
{
    public function version(): string
    {
        return phpversion();
    }

    public function hasExtension(string $extension): bool
    {
        return phpversion(strtolower($extension)) !== false;
    }
}
