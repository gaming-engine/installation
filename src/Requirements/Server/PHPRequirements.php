<?php

namespace GamingEngine\Installation\Requirements\Server;

use GamingEngine\Installation\Requirements\Server\PHP\PHPExtensionRequirement;
use GamingEngine\Installation\Requirements\Server\PHP\PHPVersionRequirement;

class PHPRequirements extends BaseServerRequirement
{
    public function name(): string
    {
        return __(
            'gaming-engine:installation::requirements.server.php.name',
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
        return __(
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
