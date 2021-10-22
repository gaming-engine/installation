<?php

namespace GamingEngine\Installation\Tests\Settings\Requirements;

use GamingEngine\Installation\Settings\Requirements\LanguageConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;

class LanguageConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function language_configuration_value_name()
    {
        // Arrange
        $subject = new LanguageConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => 'config',
            'environmentVariable' => 'FOO',
        ]);

        // Act
        $result = $subject->name();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.language.{$attribute}.title"),
            $result
        );
    }

    /**
     * @test
     */
    public function language_configuration_value_description()
    {
        // Arrange
        $subject = new LanguageConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => 'config',
            'environmentVariable' => 'hi',
        ]);

        // Act
        $result = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.language.{$attribute}.description"),
            $result
        );
    }

    /**
     * @test
     */
    public function language_configuration_value_available_options()
    {
        // Arrange
        File::shouldReceive('directories')
            ->andReturn([
                'hi',
                'bye',
                'slash/other',
            ]);

        $subject = new LanguageConfigurationValue([
            'attribute' => 'foo',
            'configurationKey' => 'config',
            'environmentVariable' => 'hi',
        ]);

        // Act
        $result = $subject->available();

        // Assert
        $this->assertEquals([
            'hi',
            'bye',
            'other',
        ], $result);
    }
}
