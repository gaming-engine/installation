<?php

namespace GamingEngine\Installation\Tests\Settings\Steps;

use GamingEngine\Installation\Install\UpdatesConfiguration;
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
        $subject = app(LanguageSettingsStep::class);

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
        $subject = app(LanguageSettingsStep::class);

        // Act
        $result = $subject->name();

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.settings.language.title'),
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
        $subject = app(LanguageSettingsStep::class);

        // Act
        $results = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $results->count()
        );
    }

    /**
     * @test
     */
    public function language_settings_step_apply_updates_the_configuration()
    {
        // Arrange
        $subject = new LanguageSettingsStep(
            $writer = $this->mock(UpdatesConfiguration::class)
        );

        $writer->shouldReceive('update')
            ->withArgs(
                fn ($values, $backupPrefix) => 'language' === $backupPrefix
                    && array_key_exists('APP_LOCALE', $values)
                    && 'en' === $values['APP_LOCALE']
            );

        // Act
        $subject->apply();

        // Assert
    }
}
