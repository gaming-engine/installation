<?php

namespace GamingEngine\Installation\Requirements\Server;

use GamingEngine\Installation\Requirements\Server\File\FileExistenceRequirement;
use GamingEngine\Installation\Requirements\Server\File\WritableFileRequirement;

class FileRequirements extends BaseServerRequirement
{
    public function identifier(): string
    {
        return 'file';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.server.file.name');
    }

    public function description(): string
    {
        return __('gaming-engine:installation::requirements.server.file.description');
    }

    public function checks(): array
    {
        return [
            new FileExistenceRequirement(
                __('gaming-engine:installation::requirements.server.file.paths.environment'),
                base_path('.env')
            ),
            new WritableFileRequirement(
                __('gaming-engine:installation::requirements.server.file.paths.environment'),
                base_path('.env')
            ),
        ];
    }
}
