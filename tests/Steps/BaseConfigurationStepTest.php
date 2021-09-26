<?php

namespace GamingEngine\Installation\Tests\Steps;

use GamingEngine\Installation\Steps\BaseConfigurationStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class BaseConfigurationStepTest extends TestCase
{
    /**
     * @test
     */
    public function base_configuration_step_override_stores_the_parameter()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            BaseConfigurationStep::class
        );
        $overrides = [
            'foo' => 'bar',
        ];

        $subject->override($overrides);

        // Act
        $response = $subject->overrides();

        // Assert
        $this->assertEquals($overrides, $response);
    }

    /**
     * @test
     */
    public function base_configuration_step_override_is_cached()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            BaseConfigurationStep::class
        );


        $overrides = [
            'foo' => 'bar',
        ];

        Storage::shouldReceive('put')
            ->withArgs([
                'installation/' . md5(get_class($subject)),
                base64_encode(
                    serialize($overrides)
                ),
            ]);

        // Act
        $subject->override($overrides);

        // Assert
    }

    /**
     * @test
     */
    public function base_configuration_step_override_reloaded()
    {
        // Arrange
        $overrides = [
            'foo' => 'bar',
        ];

        $fileName = 'installation/' . md5('Testing');

        Storage::shouldReceive('exists')
            ->withArgs([
                $fileName,
            ])->andReturnTrue();

        Storage::shouldReceive('get')
            ->withArgs([
                $fileName,
            ])->andReturn(base64_encode(
                serialize($overrides)
            ));

        Storage::shouldReceive('put');

        // Act
        $subject = $this->getMockForAbstractClass(
            BaseConfigurationStep::class,
            [],
            'Testing'
        );

        // Assert
        $this->assertEquals(
            $overrides,
            $subject->overrides()
        );
    }
}
