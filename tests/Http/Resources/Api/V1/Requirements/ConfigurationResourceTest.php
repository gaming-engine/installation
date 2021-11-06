<?php

namespace GamingEngine\Installation\Tests\Http\Resources\Api\V1\Requirements;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ConfigurationResource;
use GamingEngine\Installation\Requirements\Configuration\EnvironmentConfigurationValue;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ConfigurationResourceTest extends TestCase
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
        $resource->shouldReceive('title')
            ->andReturn($title = $this->faker->name);
        $resource->shouldReceive('description')
            ->andReturn($description = $this->faker->slug);
        $resource->shouldReceive('value')
            ->andReturn($value = $this->faker->slug);
        $resource->shouldReceive('nullable')
            ->andReturn($nullable = $this->faker->boolean);

        $subject = new ConfigurationResource($resource);

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertEquals(
            compact('attribute', 'title', 'description', 'value', 'nullable'),
            $response
        );
    }
}
