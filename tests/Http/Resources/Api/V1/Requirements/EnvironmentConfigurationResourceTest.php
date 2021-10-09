<?php

namespace GamingEngine\Installation\Tests\Api\V1\Requirements;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\EnvironmentConfigurationResource;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class EnvironmentConfigurationResourceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function configuration_requirement_contract()
    {
        // Arrange
        $resource = $this->mock(EnvironmentConfigurationValue::class);
        $resource->shouldReceive('attribute')
            ->andReturn($attribute = $this->faker->slug);
        $resource->shouldReceive('name')
            ->andReturn($name = $this->faker->name);
        $resource->shouldReceive('description')
            ->andReturn($description = $this->faker->slug);
        $resource->shouldReceive('value')
            ->andReturn($value = $this->faker->slug);
        $resource->shouldReceive('nullable')
            ->andReturn($nullable = $this->faker->boolean);

        $subject = new EnvironmentConfigurationResource($resource);

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertEquals(
            compact('attribute', 'name', 'description', 'value', 'nullable'),
            $response
        );
    }
}
