<?php

namespace GamingEngine\Installation\Tests\Feature\Requirements\Database;

use GamingEngine\Installation\Requirements\Account\AccountConfigurationRequirements;
use GamingEngine\Installation\Requirements\Account\AccountConfigurationValue;
use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AccountConfigurationRequirementsTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function account_configuration_requirements_name()
    {
        // Arrange
        $subject = new AccountConfigurationRequirements();

        // Act
        $name = $subject->name();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.account.configuration.name"),
            $name
        );
    }

    /**
     * @test
     */
    public function account_configuration_requirements_description()
    {
        // Arrange
        $subject = new AccountConfigurationRequirements();

        // Act
        $name = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.account.configuration.description"),
            $name
        );
    }

    /**
     * @test
     */
    public function account_configuration_requirements_identifier()
    {
        // Arrange
        $subject = new AccountConfigurationRequirements();

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
    public function account_configuration_requirements_has_components()
    {
        // Arrange
        $subject = new AccountConfigurationRequirements();

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
    public function account_configuration_requirements_overrides_are_applied()
    {
        // Arrange
        $subject = new AccountConfigurationRequirements([
            'email' => $email = $this->faker->email,
        ]);

        // Act
        $response = $subject->components()
            ->first(fn (AccountConfigurationValue $value) => $value->attribute() === 'email');

        // Assert
        $this->assertNotNull($response);
        $this->assertEquals(
            $email,
            $response->value()
        );
    }

    /**
     * @test
     */
    public function account_configuration_requirements_check_returns_false_if_some_are_incomplete()
    {
        // Arrange
        $subject = $this->createStub(
            AccountConfigurationRequirements::class,
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
    public function account_configuration_requirements_check_returns_true_if_some_are_complete()
    {
        // Arrange
        $subject = $this->createPartialMock(
            AccountConfigurationRequirements::class,
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
