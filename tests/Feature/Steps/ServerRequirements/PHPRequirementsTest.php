<?php

namespace GamingEngine\Installation\Tests\Step\ServerRequirements;

use GamingEngine\Installation\Steps\ServerRequirements\PHPRequirements;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Str;

class PHPRequirementsTest extends TestCase
{
    /**
     * @test
     */
    public function php_requirements_can_get_the_name()
    {
        // Arrange
        $subject = new PHPRequirements();

        // Act

        // Assert
        $this->assertTrue(
            Str::contains($subject->name(), 'PHP Requirements')
        );
        $this->assertTrue(
            Str::contains($subject->name(), phpversion())
        );
    }

    /**
     * @test
     */
    public function php_requirements_check_lists_default_requirements()
    {
        // Arrange
        $subject = new PHPRequirements();

        // Act

        // Assert
        $this->assertGreaterThan(
            1,
            $subject->components()->count()
        );
    }
}
