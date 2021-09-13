<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\Server\FileRequirements;
use GamingEngine\Installation\Requirements\Server\FolderRequirements;
use GamingEngine\Installation\Requirements\Server\PHPRequirements;
use Illuminate\Support\Collection;

class ServerRequirementsStep extends BaseStep implements Step
{
    public function identifier(): string
    {
        return 'server-requirements';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.server.name');
    }

    /**
     * @return Collection<Requirement>
     */
    public function checks(): Collection
    {
        return collect([
            new PHPRequirements(),
            new FolderRequirements(),
            new FileRequirements(),
        ]);
    }
}
