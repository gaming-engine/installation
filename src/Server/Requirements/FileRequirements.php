<?php

namespace GamingEngine\Installation\Server\Requirements;

use GamingEngine\Installation\Server\Requirements\File\FileExistenceRequirement;
use GamingEngine\Installation\Server\Requirements\File\WritableFileRequirement;

class FileRequirements extends BaseServerRequirement
{
    public function identifier(): string
    {
        return 'file';
    }

    public function name(): string
    {
        return (string)__('gaming-engine:installation::requirements.server.file.title');
    }

    public function description(): string
    {
        return (string)__('gaming-engine:installation::requirements.server.file.description');
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
