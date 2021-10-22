<?php

namespace GamingEngine\Installation\Server\Requirements;

use GamingEngine\Installation\Server\Requirements\PHP\PHPExtensionRequirement;
use GamingEngine\Installation\Server\Requirements\PHP\PHPVersionRequirement;

class PHPRequirements extends BaseServerRequirement
{
    public function name(): string
    {
        return (string)__(
            'gaming-engine:installation::requirements.server.php.title',
            [
                'version' => phpversion(),
            ]
        );
    }

    public function identifier(): string
    {
        return 'php-requirements';
    }

    public function description(): string
    {
        return (string)__(
            'gaming-engine:installation::requirements.server.php.description',
            [
                'version' => phpversion(),
            ]
        );
    }

    protected function checks(): array
    {
        return [
            new PHPVersionRequirement(),
            new PHPExtensionRequirement('BCMath'),
            new PHPExtensionRequirement('CType'),
            new PHPExtensionRequirement('Fileinfo'),
            new PHPExtensionRequirement('JSON'),
            new PHPExtensionRequirement('Mbstring'),
            new PHPExtensionRequirement('OpenSSL'),
            new PHPExtensionRequirement('PDO'),
            new PHPExtensionRequirement('Tokenizer'),
            new PHPExtensionRequirement('XML'),
        ];
    }
}
