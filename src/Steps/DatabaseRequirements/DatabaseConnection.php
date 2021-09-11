<?php

namespace GamingEngine\Installation\Steps\DatabaseRequirements;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Steps\RequirementDetail;

class DatabaseConnection implements RequirementDetail
{
    private ChecksDatabaseConnection $databaseConnection;
    private DatabaseConfiguration $configuration;

    public function __construct(ChecksDatabaseConnection $databaseConnection, DatabaseConfiguration $configuration)
    {
        $this->databaseConnection = $databaseConnection;
        $this->configuration = $configuration;
    }

    public function description(): string
    {
        return __("gaming-engine:installation::requirements.database.connection.description");
    }

    public function check(): bool
    {
        return $this->databaseConnection->test($this->configuration);
    }
}
