<?php

namespace GamingEngine\Installation\Tests\Database\Steps;

use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Tests\TestCase;

class DatabaseRequirementsStepTest extends TestCase
{
    /**
     * @test
     */
    public function database_requirements_step_identifier()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $identifier = $subject->identifier();

        // Assert
        $this->assertEquals(
            'database-requirements',
            $identifier
        );
    }

    /**
     * @test
     */
    public function database_requirements_step_name()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $name = $subject->name();

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.database.name'),
            $name
        );
    }

    /**
     * @test
     */
    public function database_requirements_step_checks_contain_values()
    {
        // Arrange
        $subject = app(DatabaseRequirementsStep::class);

        // Act
        $checks = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $checks->count()
        );
    }
}
