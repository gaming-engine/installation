<?php

namespace GamingEngine\Installation\Server\Requirements\PHP;

use GamingEngine\Installation\Helpers\PHP\PHPFeatureInformation;
use GamingEngine\Installation\Requirements\RequirementDetail;

class PHPExtensionRequirement implements RequirementDetail
{
    private string $extension;

    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    public function description(): string
    {
        return (string)__(
            'gaming-engine:installation::requirements.server.php.extension.message',
            [
                'extension' => $this->extension,
            ]
        );
    }

    public function check(): bool
    {
        return app(PHPFeatureInformation::class)
            ->hasExtension($this->extension);
    }
}
