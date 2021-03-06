<?php

namespace GamingEngine\Installation\Tests\Server\Requirements;

use GamingEngine\Installation\Server\Requirements\PHPRequirements;
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
            Str::contains($subject->title(), 'PHP Requirements')
        );
        $this->assertTrue(
            Str::contains($subject->title(), phpversion())
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
