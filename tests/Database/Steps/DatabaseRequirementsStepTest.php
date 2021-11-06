<?php

namespace GamingEngine\Installation\Tests\Database\Steps;

use GamingEngine\Installation\Database\Exceptions\MigrationException;
use GamingEngine\Installation\Database\Exceptions\PublishException;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command;

class DatabaseRequirementsStepTest extends TestCase
{
    /**
     * @test
     */
    public function database_requirements_step_identifier()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $identifier = $subject->identifier();

        // Assert
        $this->assertEquals(
            'database',
            $identifier
        );
    }

    /**
     * @test
     */
    public function database_requirements_step_name()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $name = $subject->title();

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.database.title'),
            $name
        );
    }

    /**
     * @test
     */
    public function database_requirements_step_checks_contain_values()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $checks = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $checks->count()
        );
    }

    /**
     * @test
     */
    public function database_requirements_step_apply_actions()
    {
        // Arrange
        $configuration = $this->mock(UpdatesEnvironment::class);
        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'vendor:publish' === $command;
            })
            ->twice()
            ->andReturn(Command::SUCCESS);

        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'migrate' === $command;
            })
            ->once()
            ->andReturn(Command::SUCCESS);

        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'db:seed' === $command;
            })
            ->once()
            ->andReturn(Command::SUCCESS);

        $configuration->shouldReceive('update')
            ->once()
            ->andReturnTrue();

        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $subject->apply();

        // Assert
    }

    /**
     * @test
     */
    public function database_requirements_step_apply_throws_a_publish_exception_if_publish_fails()
    {
        // Arrange
        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'vendor:publish' === $command;
            })
            ->once()
            ->andReturn(Command::FAILURE);

        Artisan::shouldReceive('output')
            ->andReturn('Testing Output');

        $subject = app(DatabaseRequirementsStep::class);

        $this->expectException(PublishException::class);

        // Act
        $subject->apply();

        // Assert
    }

    /**
     * @test
     */
    public function database_requirements_step_apply_throws_a_publish_exception_if_publish_of_seeders_fails()
    {
        // Arrange
        Artisan::shouldReceive('call')
            ->withArgs(
                fn ($command, $arguments) => 'vendor:publish' === $command
                    && 'gaming-engine:core-migrations' === $arguments['--tag']
            )
            ->once()
            ->andReturn(Command::SUCCESS);

        Artisan::shouldReceive('call')
            ->withArgs(
                fn ($command, $arguments) => 'vendor:publish' === $command
                    && 'gaming-engine:core-seeders' === $arguments['--tag']
            )
            ->once()
            ->andReturn(Command::FAILURE);

        Artisan::shouldReceive('output')
            ->andReturn('Testing Output');

        $subject = app(DatabaseRequirementsStep::class);

        $this->expectException(PublishException::class);

        // Act
        $subject->apply();

        // Assert
    }

    /**
     * @test
     */
    public function database_requirements_step_apply_throws_a_migration_exception_if_migration_fails()
    {
        // Arrange
        $configuration = $this->mock(UpdatesEnvironment::class);
        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'vendor:publish' === $command;
            })
            ->andReturn(Command::SUCCESS)
            ->twice();

        Artisan::shouldReceive('call')
            ->withArgs(function ($command) {
                return 'migrate' === $command;
            })
            ->andReturn(Command::FAILURE)
            ->once();

        Artisan::shouldReceive('output')
            ->andReturn('Migration Error');

        $configuration->shouldReceive('update')
            ->once()
            ->andReturnTrue();

        $subject = app(DatabaseRequirementsStep::class);

        $this->expectException(MigrationException::class);

        // Act
        $subject->apply();

        // Assert
    }
}
