<?php

namespace GamingEngine\Installation\Server\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Requirements\FileRequirements;
use GamingEngine\Installation\Server\Requirements\FolderRequirements;
use GamingEngine\Installation\Server\Requirements\PHPRequirements;
use GamingEngine\Installation\Steps\BaseStep;
use Illuminate\Support\Collection;

class ServerRequirementsStep extends BaseStep
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
