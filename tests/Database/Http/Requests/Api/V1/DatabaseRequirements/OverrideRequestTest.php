<?php

namespace GamingEngine\Installation\Tests\Database\Http\Requests\Api\V1\DatabaseRequirements;

use GamingEngine\Installation\Database\Http\Requests\Api\V1\OverrideRequest;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class OverrideRequestTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function override_request_automatically_nullable_items_are_not_required()
    {
        // Arrange
        $configuration = $this->mock(EnvironmentConfigurationValue::class);
        $configuration->shouldReceive('attribute')
            ->andReturn($attribute = $this->faker->slug);
        $configuration->shouldReceive('nullable')
            ->andReturnTrue();

        $requirements = $this->mock(DatabaseConfigurationRequirements::class);
        $requirements->shouldReceive('components')
            ->andReturn(collect([$configuration]));

        /**
         * @var OverrideRequest $subject
         */
        $subject = app(OverrideRequest::class);

        // Act
        $rules = $subject->rules();

        // Assert
        $this->assertEquals([
            $attribute => [
                'nullable',
            ],
        ], $rules);
    }

    /**
     * @test
     */
    public function override_request_automatically_non_nullable_items_are_required()
    {
        // Arrange
        $this->fakeValidator();

        $configuration = $this->mock(EnvironmentConfigurationValue::class);
        $configuration->shouldReceive('attribute')
            ->andReturn($attribute = $this->faker->slug);
        $configuration->shouldReceive('nullable')
            ->andReturnFalse();

        $requirements = $this->mock(DatabaseConfigurationRequirements::class);
        $requirements->shouldReceive('components')
            ->andReturn(collect([$configuration]));

        /**
         * @var OverrideRequest $subject
         */
        $subject = app(OverrideRequest::class);

        // Act
        $rules = $subject->rules();

        // Assert
        $this->assertEquals([
            $attribute => [
                'required',
            ],
        ], $rules);
    }
}
