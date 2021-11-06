<?php

namespace GamingEngine\Installation\Tests\Settings\Requirements;

use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Tests\TestCase;

class LanguageSettingsTest extends TestCase
{
    /**
     * @test
     */
    public function language_settings_identifier()
    {
        // Arrange
        $subject = new LanguageSettings();

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
    public function language_settings_name()
    {
        // Arrange
        $subject = new LanguageSettings();

        // Act
        $result = $subject->title();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.language.title"),
            $result
        );
    }

    /**
     * @test
     */
    public function language_settings_description()
    {
        // Arrange
        $subject = new LanguageSettings();

        // Act
        $result = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.language.description"),
            $result
        );
    }

    /**
     * @test
     */
    public function language_settings_checks_returns_true_if_all_complete()
    {
        // Arrange
        $requirement = $this->mock(RequirementDetail::class);
        $requirement->shouldReceive('check')
            ->andReturn(true);

        $subject = $this->createPartialMock(LanguageSettings::class, [
            'components',
        ]);

        $subject->expects($this->once())
            ->method('components')
            ->willReturn(collect([$requirement]));

        // Act

        // Assert
        $this->assertTrue(
            $subject->check()
        );
    }

    /**
     * @test
     */
    public function language_settings_checks_returns_false_if_all_are_not_complete()
    {
        // Arrange
        $requirement = $this->mock(RequirementDetail::class);
        $requirement->shouldReceive('check')
            ->andReturn(false);

        $subject = $this->createPartialMock(LanguageSettings::class, [
            'components',
        ]);

        $subject->expects($this->once())
            ->method('components')
            ->willReturn(collect([$requirement]));

        // Act

        // Assert
        $this->assertFalse(
            $subject->check()
        );
    }

    /**
     * @test
     */
    public function language_settings_components()
    {
        // Arrange
        $subject = new LanguageSettings();

        // Act
        $result = $subject->components();

        // Assert
        $this->assertGreaterThan(
            0,
            $result->count(),
        );
    }
}
