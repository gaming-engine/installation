<?php

namespace GamingEngine\Installation\Tests\Feature\Steps\ServerRequirements\PHPRequirements;

use GamingEngine\Installation\Helpers\PHP\PHPFeatureInformation;
use GamingEngine\Installation\Steps\ServerRequirements\PHPRequirements\PHPExtensionRequirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class PHPExtensionRequirementTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function php_extension_requirement_includes_extension_name_in_the_description()
    {
        // Arrange
        $name = $this->faker->name;
        $subject = new PHPExtensionRequirement($name);

        // Act

        // Assert
        $this->assertTrue(
            Str::contains($subject->description(), $name)
        );
    }

    /**
     * @test
     */
    public function php_extension_requirement_check_returns_false_if_the_extension_doesnt_exist()
    {
        // Arrange
        $name = $this->faker->name;
        $subject = new PHPExtensionRequirement($name);
        $this->mock(PHPFeatureInformation::class)
            ->shouldReceive('hasExtension')
            ->withArgs([
                $name,
            ])
            ->andReturnFalse();

        // Act

        // Assert
        $this->assertFalse($subject->check());
    }

    /**
     * @test
     */
    public function php_extension_requirement_check_returns_true_if_the_extension_exists()
    {
        // Arrange
        $name = $this->faker->name;
        $subject = new PHPExtensionRequirement($name);
        $this->mock(PHPFeatureInformation::class)
            ->shouldReceive('hasExtension')
            ->withArgs([
                $name,
            ])
            ->andReturnTrue();

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }
}
