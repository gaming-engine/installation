<?php

namespace GamingEngine\Installation\Server\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Requirements\FileRequirements;
use GamingEngine\Installation\Server\Requirements\FolderRequirements;
use GamingEngine\Installation\Server\Requirements\PHPRequirements;
use GamingEngine\Installation\Steps\BaseStep;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class ServerRequirementsStep extends BaseStep
{
    public function identifier(): string
    {
        return 'server';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.server.title');
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

    public function apply(): void
    {
        Artisan::call('storage:link', [
            '--force' => true,
        ]);

        Artisan::call('vendor:publish', [
            '--tag' => 'gaming-engine:core-resources',
        ]);
    }
}
