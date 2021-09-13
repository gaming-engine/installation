<?php

namespace GamingEngine\Installation\Tests\Feature\Requirements\Database;

use GamingEngine\Installation\Requirements\Database\DatabaseConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use InvalidArgumentException;

class DatabaseConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function database_configuration_value_description()
    {
        // Arrange
        $subject = new DatabaseConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => $this->faker->slug,
            'environmentVariable' => $this->faker->slug,
        ]);

        // Act
        $description = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.configuration.{$attribute}.description"),
            $description
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_name()
    {
        // Arrange
        $subject = new DatabaseConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => $this->faker->slug,
            'environmentVariable' => $this->faker->slug,
        ]);

        // Act
        $name = $subject->name();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.configuration.{$attribute}.name"),
            $name
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_retrieves_configuration_value_if_not_overridden()
    {
        // Arrange
        $subject = new DatabaseConfigurationValue([
            'attribute' => $this->faker->slug,
            'configurationKey' => $configuration = $this->faker->slug,
            'environmentVariable' => $this->faker->slug,
        ]);

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($value = $this->faker->slug);

        // Act
        $response = $subject->value();

        // Assert
        $this->assertEquals(
            $value,
            $response
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_retrieves_the_overridden_value_instead_of_the_default()
    {
        // Arrange
        $subject = new DatabaseConfigurationValue([
            'attribute' => $this->faker->slug,
            'configurationKey' => $configuration = $this->faker->slug,
            'environmentVariable' => $this->faker->slug,
        ]);

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($defaultValue = $this->faker->slug);

        // Act
        $subject->override(
            $override = $this->faker->slug
        );

        // Assert
        $this->assertEquals(
            $override,
            $subject->value()
        );
        $this->assertNotEquals(
            $defaultValue,
            $subject->value()
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_cannot_be_overridden_to_null_if_nullable()
    {
        // Arrange
        $subject = new DatabaseConfigurationValue([
            'attribute' => $this->faker->slug,
            'configurationKey' => $configuration = $this->faker->slug,
            'environmentVariable' => $this->faker->slug,
        ]);

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($this->faker->slug);

        Config::shouldReceive('offsetGet');

        $this->expectException(InvalidArgumentException::class);

        // Act
        $subject->override(null);

        // Assert
    }
}
