<?php

namespace GamingEngine\Installation\Tests\Settings\Requirements;

use GamingEngine\Installation\Settings\Requirements\SiteConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class SiteConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function site_details_value_name()
    {
        // Arrange
        $subject = new SiteConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => 'config',
            'environmentVariable' => 'FOO',
        ]);

        // Act
        $result = $subject->title();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.site.{$attribute}.title"),
            $result
        );
    }

    /**
     * @test
     */
    public function site_details_value_description()
    {
        // Arrange
        $subject = new SiteConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'configurationKey' => 'config',
            'environmentVariable' => 'hi',
        ]);

        // Act
        $result = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.site.{$attribute}.description"),
            $result
        );
    }
}
