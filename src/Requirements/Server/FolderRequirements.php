<?php

namespace GamingEngine\Installation\Requirements\Server;

use GamingEngine\Installation\Requirements\Server\Folder\FolderExistenceRequirement;
use GamingEngine\Installation\Requirements\Server\Folder\WritableFolderRequirement;

class FolderRequirements extends BaseServerRequirement
{
    public function identifier(): string
    {
        return 'folder';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.server.folder.name');
    }

    public function description(): string
    {
        return __('gaming-engine:installation::requirements.server.folder.description');
    }

    public function checks(): array
    {
        return [
            new FolderExistenceRequirement(
                __('gaming-engine:installation::requirements.server.folder.paths.public-storage'),
                storage_path('app/public')
            ),
            new WritableFolderRequirement(
                __('gaming-engine:installation::requirements.server.folder.paths.public-storage'),
                storage_path('app/public')
            ),
            new FolderExistenceRequirement(
                __('gaming-engine:installation::requirements.server.folder.paths.storage-link'),
                public_path('storage')
            ),
            new WritableFolderRequirement(
                __('gaming-engine:installation::requirements.server.folder.paths.storage-link'),
                public_path('storage')
            ),
        ];
    }
}
