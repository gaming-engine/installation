<?php

namespace GamingEngine\Installation\Tests\Feature\Steps\ServerRequirements\PHPRequirements;

use GamingEngine\Installation\Helpers\PHP\PHPFeatureInformation;
use GamingEngine\Installation\Steps\ServerRequirements\PHPRequirements\PHPVersionRequirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class PHPVersionRequirementTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function php_version_requirement_includes_the_php_version()
    {
        // Arrange
        $subject = new PHPVersionRequirement();

        // Act

        // Assert
        $this->assertTrue(
            Str::contains($subject->description(), PHPVersionRequirement::MINIMUM_VERSION)
        );
    }

    /**
     * @test
     */
    public function php_version_requirement_check_returns_false_if_the_an_earlier_version_of_php_is_installed()
    {
        // Arrange
        $subject = new PHPVersionRequirement();
        $this->mock(PHPFeatureInformation::class)
            ->shouldReceive('version')
            ->andReturn('5.6');

        // Act

        // Assert
        $this->assertFalse($subject->check());
    }

    /**
     * @test
     */
    public function php_extension_requirement_check_returns_true_if_the_exact_version_of_php_is_installed()
    {
        // Arrange
        $subject = new PHPVersionRequirement();
        $this->mock(PHPFeatureInformation::class)
            ->shouldReceive('version')
            ->andReturn('8.0');

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }

    /**
     * @test
     */
    public function php_extension_requirement_check_returns_true_if_a_better_version_of_php_is_installed()
    {
        // Arrange
        $subject = new PHPVersionRequirement();
        $this->mock(PHPFeatureInformation::class)
            ->shouldReceive('version')
            ->andReturn('8.1');

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }
}
