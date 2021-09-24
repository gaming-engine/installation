<?php

namespace GamingEngine\Installation\Tests\Feature\Requirements\Configuration;

use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use InvalidArgumentException;

class EnvironmentConfigurationValueTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function configuration_value_attribute()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $value = $this->faker->slug,
                    'configurationKey' => $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
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
    public function configuration_value_environmentVariable()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $this->faker->slug,
                    'environmentVariable' => $value = $this->faker->slug,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertEquals(
            $value,
            $subject->environmentVariable(),
        );
    }

    /**
     * @test
     */
    public function configuration_value_key()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $value = $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
                ],
            ]
        );

        // Act

        // Assert
        $this->assertEquals(
            $value,
            $subject->key(),
        );
    }

    /**
     * @test
     */
    public function configuration_value_nullable_defaults_to_false()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
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
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
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
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
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
    public function configuration_value_retrieves_the_value_from_the_config_file()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $key = $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
                ],
            ]
        );

        Config::shouldReceive('offsetGet', 'get')
            ->withArgs(function ($configurationKey) use ($key) {
                return Str::endsWith($configurationKey, $key);
            })
            ->andReturn($value = $this->faker->slug);

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
    public function database_configuration_value_retrieves_configuration_value_if_not_overridden()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $configuration = $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
                ],
            ]
        );

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($value = $this->faker->slug);

        // Act
        $response = $subject->value();

        // Assert
        $this->assertEquals(
            $value,
            $response
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_retrieves_the_overridden_value_instead_of_the_default()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $configuration = $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
                ],
            ]
        );

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($defaultValue = $this->faker->slug);

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
            $defaultValue,
            $subject->value()
        );
    }

    /**
     * @test
     */
    public function database_configuration_value_cannot_be_overridden_to_null_if_not_nullable()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            EnvironmentConfigurationValue::class,
            [
                'arguments' => [
                    'attribute' => $this->faker->slug,
                    'configurationKey' => $configuration = $this->faker->slug,
                    'environmentVariable' => $this->faker->slug,
                    'nullable' => false,
                ],
            ]
        );

        Config::shouldReceive('get')
            ->withArgs(function ($key) use ($configuration) {
                return Str::endsWith($key, $configuration);
            })
            ->andReturn($this->faker->slug);

        Config::shouldReceive('offsetGet');

        $this->expectException(InvalidArgumentException::class);

        // Act
        $subject->override(null);

        // Assert
    }
}
