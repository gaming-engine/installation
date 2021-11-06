<?php

namespace GamingEngine\Installation\Tests\Http\Resources\Api\V1\Steps;

use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\Step;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;

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

        URL::spy();

        $resource->shouldReceive('identifier')
            ->andReturn($identifier = $this->faker->slug);
        $resource->shouldReceive('title')
            ->andReturn($title = $this->faker->name);
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
            $title,
            $response['title']
        );
        $this->assertEquals(
            $complete,
            $response['is_complete']
        );
    }
}
