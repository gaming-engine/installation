<?php

namespace GamingEngine\Installation\Tests\Api\V1\Requirements;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Steps\Requirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class RequirementResourceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function requirement_resource_output_contract()
    {
        // Arrange
        $resource = $this->mock(Requirement::class);
        $subject = new RequirementResource($resource);

        $resource->shouldReceive('name')
            ->andReturn($name = $this->faker->name);
        $resource->shouldReceive('description')
            ->andReturn($description = $this->faker->name);
        $resource->shouldReceive('check')
            ->andReturn($complete = $this->faker->boolean);
        $resource->shouldReceive('components')
            ->andReturn(collect());

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertIsArray($response);
        $this->assertEquals(
            $name,
            $response['name']
        );
        $this->assertEquals(
            $description,
            $response['description']
        );
        $this->assertEquals(
            $complete,
            $response['is_complete']
        );
    }
}
