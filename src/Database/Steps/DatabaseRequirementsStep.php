<?php

namespace GamingEngine\Installation\Database\Steps;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\Requirements\ConnectsToDatabaseRequirement;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;

class DatabaseRequirementsStep extends BaseConfigurationStep
{
    private ChecksDatabaseConnection $databaseConnection;

    public function __construct(ChecksDatabaseConnection $databaseConnection)
    {
        parent::__construct();
        $this->databaseConnection = $databaseConnection;
    }

    public function identifier(): string
    {
        return 'database-requirements';
    }

    public function name(): string
    {
        return __('gaming-engine:installation::requirements.database.name');
    }

    /**
     * @return Collection<Requirement>
     */
    public function checks(): Collection
    {
        $databaseConfiguration = new DatabaseConfigurationRequirements(
            $this->overrides
        );

        return collect([
            $databaseConfiguration,
            new ConnectsToDatabaseRequirement(
                $this->databaseConnection,
                new DatabaseConfiguration(
                    $databaseConfiguration->components()
                        ->keyBy(fn (EnvironmentConfigurationValue $value) => $value->attribute())
                        ->map(fn (EnvironmentConfigurationValue $value) => $value->value())
                        ->toArray()
                )
            ),
        ]);
    }
}
