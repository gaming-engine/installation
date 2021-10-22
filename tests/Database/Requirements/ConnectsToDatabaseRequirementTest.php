<?php

namespace GamingEngine\Installation\Tests\Database\Requirements;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\Requirements\ConnectsToDatabaseRequirement;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Tests\TestCase;

class ConnectsToDatabaseRequirementTest extends TestCase
{
    private ChecksDatabaseConnection $databaseConnection;
    private DatabaseConfiguration $configuration;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseConnection = $this->mock(ChecksDatabaseConnection::class);
        $this->configuration = $this->mock(DatabaseConfiguration::class);
    }

    /**
     * @test
     */
    public function connects_to_database_requirement_name()
    {
        // Arrange
        $subject = new ConnectsToDatabaseRequirement(
            $this->databaseConnection,
            $this->configuration
        );

        // Act
        $name = $subject->name();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.connection.title"),
            $name
        );
    }

    /**
     * @test
     */
    public function connects_to_database_requirement_description()
    {
        // Arrange
        $subject = new ConnectsToDatabaseRequirement(
            $this->databaseConnection,
            $this->configuration
        );

        // Act
        $description = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.connection.description"),
            $description
        );
    }

    /**
     * @test
     */
    public function connects_to_database_requirement_has_components()
    {
        // Arrange
        $subject = new ConnectsToDatabaseRequirement(
            $this->databaseConnection,
            $this->configuration
        );

        // Act

        // Assert
        $this->assertGreaterThan(
            0,
            $subject->components()->count()
        );
    }
}
