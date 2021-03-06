<?php

namespace GamingEngine\Installation\Tests\Database\Requirements;

use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationValue;
use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class DatabaseConfigurationRequirementsTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function database_configuration_requirements_name()
    {
        // Arrange
        $subject = new DatabaseConfigurationRequirements();

        // Act
        $name = $subject->title();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.configuration.title"),
            $name
        );
    }

    /**
     * @test
     */
    public function database_configuration_requirements_description()
    {
        // Arrange
        $subject = new DatabaseConfigurationRequirements();

        // Act
        $name = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.database.configuration.description"),
            $name
        );
    }

    /**
     * @test
     */
    public function database_configuration_requirements_identifier()
    {
        // Arrange
        $subject = new DatabaseConfigurationRequirements();

        // Act

        // Assert
        $this->assertEquals(
            'configuration',
            $subject->identifier()
        );
    }

    /**
     * @test
     */
    public function database_configuration_requirements_has_components()
    {
        // Arrange
        $subject = new DatabaseConfigurationRequirements();

        // Act
        $response = $subject->components();

        // Assert
        $this->assertGreaterThan(
            0,
            $response->count()
        );
    }

    /**
     * @test
     */
    public function database_configuration_requirements_overrides_are_applied()
    {
        // Arrange
        $subject = new DatabaseConfigurationRequirements([
            'engine' => $engine = $this->faker->slug,
        ]);

        // Act
        $response = $subject->components()
            ->first(fn (DatabaseConfigurationValue $value) => $value->attribute() === 'engine');

        // Assert
        $this->assertNotNull($response);
        $this->assertEquals(
            $engine,
            $response->value()
        );
    }

    /**
     * @test
     */
    public function database_configuration_requirements_check_returns_false_if_some_are_incomplete()
    {
        // Arrange
        $subject = $this->createStub(
            DatabaseConfigurationRequirements::class,
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnFalse();

        // Act
        $response = $subject->check();

        // Assert
        $this->assertFalse($response);
    }

    /**
     * @test
     */
    public function database_configuration_requirements_check_returns_true_if_some_are_complete()
    {
        // Arrange
        $subject = $this->createPartialMock(
            DatabaseConfigurationRequirements::class,
            [
                'components',
            ]
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnTrue();

        // Act
        $response = $subject->check();

        // Assert
        $this->assertTrue($response);
    }
}
