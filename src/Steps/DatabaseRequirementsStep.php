<?php

namespace GamingEngine\Installation\Steps;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use GamingEngine\Installation\Steps\DatabaseRequirements\ConnectsToDatabaseRequirement;
use GamingEngine\Installation\Steps\DatabaseRequirements\DatabaseConfigurationRequirements;
use Illuminate\Support\Collection;

class DatabaseRequirementsStep extends BaseConfigurationStep implements Step
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
                        ->keyBy(fn (ConfigurationValue $value) => $value->attribute())
                        ->map(fn (ConfigurationValue $value) => $value->value())
                        ->toArray()
                )
            ),
        ]);
    }
}
