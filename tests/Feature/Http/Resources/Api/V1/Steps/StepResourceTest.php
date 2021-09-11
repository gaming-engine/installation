<?php

namespace GamingEngine\Installation\Tests\Feature\Api\V1\Steps;

use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\Step;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class StepResourceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function step_resource_output_contract()
    {
        // Arrange
        $resource = $this->mock(Step::class);
        $subject = new StepResource($resource);

        $resource->shouldReceive('identifier')
            ->andReturn($identifier = $this->faker->slug);
        $resource->shouldReceive('name')
            ->andReturn($name = $this->faker->name);
        $resource->shouldReceive('isComplete')
            ->andReturn($complete = $this->faker->boolean);

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertIsArray($response);
        $this->assertEquals(
            $identifier,
            $response['identifier']
        );
        $this->assertEquals(
            $name,
            $response['name']
        );
        $this->assertEquals(
            $complete,
            $response['is_complete']
        );
    }
}
