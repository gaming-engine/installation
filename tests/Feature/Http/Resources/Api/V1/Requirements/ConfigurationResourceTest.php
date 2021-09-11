<?php

namespace GamingEngine\Installation\Tests\Feature\Api\V1\Requirements;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ConfigurationResource;
use GamingEngine\Installation\Steps\ConfigurationRequirements\ConfigurationValue;
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
        $resource = $this->mock(ConfigurationValue::class);
        $resource->shouldReceive('attribute')
            ->andReturn($attribute = $this->faker->slug);
        $resource->shouldReceive('name')
            ->andReturn($name = $this->faker->name);
        $resource->shouldReceive('description')
            ->andReturn($description = $this->faker->slug);
        $resource->shouldReceive('value')
            ->andReturn($value = $this->faker->slug);

        $subject = new ConfigurationResource($resource);

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertEquals(
            compact('attribute', 'name', 'description', 'value'),
            $response
        );
    }
}
