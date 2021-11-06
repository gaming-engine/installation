<?php

namespace GamingEngine\Installation\Tests\Install\Steps;

use GamingEngine\Installation\Install\Steps\FinalizeStep;
use GamingEngine\Installation\Install\UpdatesEnvironment;
use GamingEngine\Installation\Tests\TestCase;

class FinalizeStepTest extends TestCase
{
    /**
     * @test
     */
    public function finalize_step_identifier()
    {
        // Arrange
        $subject = app(FinalizeStep::class);

        // Act
        $target = $subject->identifier();

        // Assert
        $this->assertEquals(
            'finalize',
            $target
        );
    }

    /**
     * @test
     */
    public function finalize_step_name()
    {
        // Arrange
        $subject = app(FinalizeStep::class);

        // Act
        $target = $subject->title();

        // Assert
        $this->assertEquals(
            (string)__('gaming-engine:installation::requirements.finalize.title'),
            $target
        );
    }

    /**
     * @test
     */
    public function finalize_step_contains_no_tasks()
    {
        // Arrange
        $subject = app(FinalizeStep::class);

        // Act
        $target = $subject->checks();

        // Assert
        $this->assertCount(
            0,
            $target
        );
    }

    /**
     * @test
     */
    public function finalize_step_sets_the_installation_environment_variable()
    {
        // Arrange
        $configuration = $this->mock(UpdatesEnvironment::class);
        $subject = new FinalizeStep($configuration);

        $configuration->shouldReceive('update')
            ->withArgs(
                fn ($values, $backupPrefix) => 'finalize' === $backupPrefix
                    && array_key_exists('GAMING_ENGINE_INSTALLED', $values)
                    && true === $values['GAMING_ENGINE_INSTALLED']
            );

        // Act
        $subject->apply();

        // Assert
    }
}
