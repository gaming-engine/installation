<?php

namespace GamingEngine\Installation\Server\Requirements\PHP;

use GamingEngine\Installation\Helpers\PHP\PHPFeatureInformation;
use GamingEngine\Installation\Requirements\RequirementDetail;

class PHPVersionRequirement implements RequirementDetail
{
    const MINIMUM_VERSION = '8.0';

    public function description(): string
    {
        return __(
            'gaming-engine:installation::requirements.server.php.version.message',
            [
                'version' => self::MINIMUM_VERSION,
            ]
        );
    }

    public function check(): bool
    {
        return version_compare(
            app(PHPFeatureInformation::class)->version(),
            self::MINIMUM_VERSION,
            '>='
        );
    }
}
