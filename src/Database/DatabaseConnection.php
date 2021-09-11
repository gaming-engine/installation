<?php

namespace GamingEngine\Installation\Database;

use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use Illuminate\Support\Facades\DB;
use PDOException;

class DatabaseConnection implements ChecksDatabaseConnection
{
    public function test(DatabaseConfiguration $configuration): bool
    {
        return $this->validate(
            $this->buildConfiguration($configuration)
        );
    }

    private function validate(array $configuration): bool
    {
        config()->set(
            'database.connections.test',
            $configuration
        );

        try {
            DB::connection('test')
                ->getPdo();
        } catch (PDOException $exception) {
            return false;
        }

        return true;
    }

    private function buildConfiguration(DatabaseConfiguration $configuration): array
    {
        $default = config("database.connections.$configuration->engine");

        $default['host'] = $configuration->host ?? $default['host'] ?? null;
        $default['database'] = $configuration->name ?? $default['database'] ?? null;
        $default['username'] = $configuration->username ?? $default['username'] ?? null;
        $default['password'] = $configuration->password ?? $default['password'] ?? null;

        return $default;
    }
}
