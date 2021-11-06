<?php

namespace GamingEngine\Installation\Database\Steps;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\Exceptions\MigrationException;
use GamingEngine\Installation\Database\Exceptions\PublishException;
use GamingEngine\Installation\Database\Requirements\ConnectsToDatabaseRequirement;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Steps\BaseConfigurationStep;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command as BaseCommand;

class DatabaseRequirementsStep extends BaseConfigurationStep
{
    public function __construct(
        private ChecksDatabaseConnection $databaseConnection,
        private UpdatesEnvironment $configuration
    ) {
        parent::__construct();
    }

    public function identifier(): string
    {
        return 'database';
    }

    public function title(): string
    {
        return (string)__('gaming-engine:installation::requirements.database.title');
    }

    /**
     * @throws MigrationException
     * @throws PublishException
     */
    public function apply(): void
    {
        $this->publishMigrations();
        $this->publishSeeders();
        $this->updateConfiguration();
        $this->migrateDatabase();
    }

    private function publishMigrations(): void
    {
        $publishResult = Artisan::call('vendor:publish', [
            '--tag' => 'gaming-engine:core-migrations',
        ]);

        if (BaseCommand::SUCCESS !== $publishResult) {
            throw new PublishException(Artisan::output());
        }
    }

    private function publishSeeders(): void
    {
        $publishResult = Artisan::call('vendor:publish', [
            '--tag' => 'gaming-engine:core-seeders',
        ]);

        if (BaseCommand::SUCCESS !== $publishResult) {
            throw new PublishException(Artisan::output());
        }
    }

    private function updateConfiguration(): void
    {
        /**
         * @var DatabaseConfigurationRequirements $configuration
         */
        $configuration = $this->checks()
            ->first(fn (Requirement $requirement) => $requirement instanceof DatabaseConfigurationRequirements);

        $this->configuration->update(
            $configuration->components()
                ->keyBy(fn (EnvironmentConfigurationValue $value) => $value->environmentVariable())
                ->map(fn (EnvironmentConfigurationValue $value) => $value->value())
                ->toArray(),
            'database'
        );
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

    private function migrateDatabase(): void
    {
        $migrateResult = Artisan::call('migrate', [
            '--force' => true,
        ]);

        if (BaseCommand::SUCCESS !== $migrateResult) {
            throw new MigrationException(Artisan::output());
        }

        $seedResult = Artisan::call('db:seed', [
            '--class' => 'CoreDatabaseSeeder',
        ]);
    }
}
