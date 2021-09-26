<?php

namespace GamingEngine\Installation\Tests\Database\Requirements;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\Requirements\DatabaseConnection;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /**
     * @test
     */
    public function database_connection_description()
    {
        // Arrange
        $subject = new DatabaseConnection(
            $this->mock(ChecksDatabaseConnection::class),
            $this->mock(DatabaseConfiguration::class)
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
    public function database_connection_passes_passes_through_the_response_of_the_test_successful()
    {
        // Arrange
        $configuration = $this->mock(DatabaseConfiguration::class);

        $check = $this->mock(ChecksDatabaseConnection::class);
        $check->shouldReceive('test')
            ->with($configuration)
            ->andReturnTrue();

        $subject = new DatabaseConnection($check, $configuration);

        // Act
        $response = $subject->check();

        // Assert
        $this->assertTrue($response);
    }

    /**
     * @test
     */
    public function database_connection_passes_passes_through_the_response_of_the_test_failure()
    {
        // Arrange
        $configuration = $this->mock(DatabaseConfiguration::class);

        $check = $this->mock(ChecksDatabaseConnection::class);
        $check->shouldReceive('test')
            ->with($configuration)
            ->andReturnFalse();

        $subject = new DatabaseConnection($check, $configuration);

        // Act
        $response = $subject->check();

        // Assert
        $this->assertFalse($response);
    }
}
