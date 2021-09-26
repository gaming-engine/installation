<?php

namespace GamingEngine\Installation\Tests\Requirements\Configuration;

use GamingEngine\Installation\Requirements\Configuration\ConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use InvalidArgumentException;

class ConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function configuration_value_attribute()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $value = $this->faker->slug,
                    'value' => $this->faker->slug,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertEquals(
            $value,
            $subject->attribute(),
        );
    }

    /**
     * @test
     */
    public function configuration_value_nullable_defaults_to_false()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $this->faker->slug,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertFalse($subject->nullable());
    }

    /**
     * @test
     */
    public function configuration_value_nullable_can_be_set_to_false()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $this->faker->slug,
                    'nullable' => false,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertFalse($subject->nullable());
    }

    /**
     * @test
     */
    public function configuration_value_nullable_can_be_set_to_true()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $this->faker->slug,
                    'nullable' => true,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertTrue($subject->nullable());
    }

    /**
     * @test
     */
    public function configuration_value_provides_the_default_value()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $value = $this->faker->slug,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertEquals(
            $value,
            $subject->value()
        );
    }

    /**
     * @test
     */
    public function configuration_value_can_be_overridden()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $value = $this->faker->slug,
                ],
            ]
        );

        // Act
        $subject->override($override = $this->faker->slug);

        // Assert
        $this->assertEquals(
            $override,
            $subject->value()
        );

        $this->assertNotEquals(
            $value,
            $subject->value()
        );
    }

    /**
     * @test
     */
    public function configuration_value_check_returns_true_when_nullable_and_the_value_is_empty()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => '',
                    'nullable' => true,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }

    /**
     * @test
     */
    public function configuration_value_check_returns_true_if_not_nullable_and_there_is_value()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $this->faker->slug,
                    'nullable' => false,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }

    /**
     * @test
     */
    public function configuration_value_check_returns_false_if_nullable_and_there_is_no_value()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => '',
                    'nullable' => false,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertFalse($subject->check());
    }

    /**
     * @test
     */
    public function account_configuration_value_retrieves_the_default_value_if_not_overridden()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $configuration = $this->faker->text,
                ],
            ]
        );

        // Act
        $response = $subject->value();

        // Assert
        $this->assertEquals(
            $configuration,
            $response
        );
    }

    /**
     * @test
     */
    public function account_configuration_value_retrieves_the_overridden_value_instead_of_the_default()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $configuration = $this->faker->slug,
                ],
            ]
        );

        // Act
        $subject->override(
            $override = $this->faker->slug
        );

        // Assert
        $this->assertEquals(
            $override,
            $subject->value()
        );
        $this->assertNotEquals(
            $configuration,
            $subject->value()
        );
    }

    /**
     * @test
     */
    public function account_configuration_value_cannot_be_overridden_to_null_if_not_nullable()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            ConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'value' => $this->faker->slug,
                    'nullable' => false,
                ],
            ]
        );

        $this->expectException(InvalidArgumentException::class);

        // Act
        $subject->override(null);

        // Assert
    }
}
