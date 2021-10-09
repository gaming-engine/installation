<?php

namespace GamingEngine\Installation\Tests\Settings\Steps;

use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class LanguageSettingsStepTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function language_settings_step_identifier()
    {
        // Arrange
        $subject = new LanguageSettingsStep();

        // Act
        $result = $subject->identifier();

        // Assert
        $this->assertEquals(
            'language',
            $result
        );
    }

    /**
     * @test
     */
    public function language_settings_step_name()
    {
        // Arrange
        $subject = new LanguageSettingsStep();

        // Act
        $result = $subject->name();

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.settings.language.name'),
            $result
        );
    }

    /**
     * @test
     */
    public function language_settings_step_can_get_locale()
    {
        // Arrange
        $subject = $this->createPartialMock(LanguageSettingsStep::class, [
            'checks',
        ]);

        $settings = new LanguageSettings([
            'locale' => $value = $this->faker->slug,
        ]);

        $subject->expects($this->once())
            ->method('checks')
            ->willReturn(collect([$settings]));

        // Act
        $result = $subject->locale();

        // Assert
        $this->assertEquals(
            $value,
            $result
        );
    }

    /**
     * @test
     */
    public function language_settings_step_checks_has_an_element()
    {
        // Arrange
        $subject = new LanguageSettingsStep();

        // Act
        $results = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $results->count()
        );
    }
}
