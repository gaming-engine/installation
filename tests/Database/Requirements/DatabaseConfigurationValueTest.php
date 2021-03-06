<?php

namespace GamingEngine\Installation\Tests\Database\Requirements;

use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

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
        $name = $subject->title();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.configuration.{$attribute}.title"),
            $name
        );
    }
}
