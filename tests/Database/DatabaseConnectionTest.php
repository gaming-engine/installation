<?php

use GamingEngine\Installation\Database\DatabaseConnection;
use GamingEngine\Installation\Models\Database\DatabaseConfiguration;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseConnectionTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function database_connection_creates_a_new_database_configuration()
    {
        // Arrange
        $configuration = new DatabaseConfiguration([
            'engine' => $this->faker->slug,
            'host' => $this->faker->slug,
            'name' => $this->faker->slug,
            'username' => $this->faker->slug,
            'password' => $this->faker->slug,
        ]);

        DB::shouldReceive('connection')
            ->andReturnSelf();
        DB::shouldReceive('getPdo');

        Config::shouldReceive('get', 'offsetGet');

        Config::shouldReceive('set')
            ->withArgs(function ($name, array $values) use ($configuration) {
                $this->assertEquals(
                    'database.connections.test',
                    $name
                );

                $this->assertEquals([
                    'host' => $configuration->host,
                    'database' => $configuration->name,
                    'username' => $configuration->username,
                    'password' => $configuration->password,
                ], $values);

                return true;
            });

        $subject = new DatabaseConnection();

        // Act
        $subject->test($configuration);

        // Assert
    }
}
