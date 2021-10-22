<?php

namespace GamingEngine\Installation\Tests\Install;

use GamingEngine\DotEnv\Writer;
use GamingEngine\Installation\Install\ConfigurationUpdater;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ConfigurationUpdaterTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function configuration_updater_path_defaults_to_the_environment_file()
    {
        // Arrange
        $subject = new ConfigurationUpdater(
            $this->mock(Writer::class),
            ''
        );

        // Act
        $response = $subject->path();

        // Assert
        $this->assertEquals(
            base_path('.env'),
            $response
        );
    }

    /**
     * @test
     */
    public function configuration_updater_path_accepts_a_different_path()
    {
        // Arrange
        $subject = new ConfigurationUpdater(
            $this->mock(Writer::class),
            $path = $this->faker->filePath()
        );

        // Act
        $response = $subject->path();

        // Assert
        $this->assertEquals(
            $path,
            $response
        );
    }

    /**
     * @test
     */
    public function configuration_updater_path_updates_the_configuration()
    {
        // Arrange
        $subject = new ConfigurationUpdater(
            $writer = $this->mock(Writer::class),
            $path = $this->faker->filePath()
        );

        File::shouldReceive('copy')
            ->withArgs(fn ($filePath) => $filePath === $path);

        Artisan::shouldReceive('call')
            ->withArgs(fn ($command) => 'config:cache' === $command);

        $updatedKey = $this->faker->slug;
        $updatedValue = $this->faker->boolean;

        $writer->shouldReceive('load')
            ->andReturnSelf();
        $writer->shouldReceive('setValue')
            ->withArgs(fn ($key, $value) => $key === $updatedKey && $value === $updatedValue)
            ->andReturnSelf();
        $writer->shouldReceive('write');

        // Act
        $subject->update([
            $updatedKey => $updatedValue,
        ], 'finalize');

        // Assert
    }
}
