<?php

namespace GamingEngine\Installation\Database\Requirements;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Requirements\BaseRequirement;
use GamingEngine\Installation\Requirements\Requirement;
use Illuminate\Support\Collection;

class ConnectsToDatabaseRequirement extends BaseRequirement implements Requirement
{
    private ChecksDatabaseConnection $databaseConnection;
    private DatabaseConfiguration $configuration;

    public function __construct(ChecksDatabaseConnection $databaseConnection, DatabaseConfiguration $configuration)
    {
        $this->databaseConnection = $databaseConnection;
        $this->configuration = $configuration;
    }

    public function identifier(): string
    {
        return 'connectivity';
    }

    public function title(): string
    {
        return (string)__("gaming-engine:installation::requirements.database.connection.title");
    }

    public function description(): string
    {
        return (string)__("gaming-engine:installation::requirements.database.connection.description");
    }

    public function components(): Collection
    {
        return collect([
            new DatabaseConnection(
                $this->databaseConnection,
                $this->configuration
            ),
        ]);
    }
}
