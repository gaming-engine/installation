<?php

namespace GamingEngine\Installation\Tests\Feature\Steps;

use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

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
            ConfigurationValue::class,
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
            ConfigurationValue::class,
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
            ConfigurationValue::class,
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
            ConfigurationValue::class,
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
            ConfigurationValue::class,
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
            ConfigurationValue::class,
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
}
