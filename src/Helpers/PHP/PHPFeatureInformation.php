<?php

namespace GamingEngine\Installation\Helpers\PHP;

interface PHPFeatureInformation
{
    public function version(): string;

    public function hasExtension(string $extension): bool;
}
