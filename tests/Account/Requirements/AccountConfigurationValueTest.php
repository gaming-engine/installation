<?php

namespace GamingEngine\Installation\Tests\Account\Requirements;

use GamingEngine\Installation\Account\Requirements\AccountConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AccountConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function account_configuration_value_description()
    {
        // Arrange
        $subject = new AccountConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'value' => $this->faker->text,
        ]);

        // Act
        $description = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.account.configuration.{$attribute}.description"),
            $description
        );
    }

    /**
     * @test
     */
    public function account_configuration_value_name()
    {
        // Arrange
        $subject = new AccountConfigurationValue([
            'attribute' => $attribute = $this->faker->slug,
            'value' => $this->faker->text,
        ]);

        // Act
        $name = $subject->name();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.account.configuration.{$attribute}.name"),
            $name
        );
    }
}
