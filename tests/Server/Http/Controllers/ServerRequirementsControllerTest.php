<?php

namespace GamingEngine\Installation\Tests\Server\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Http\Controllers\Api\V1\ServerRequirementsController;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
use GamingEngine\Installation\Tests\TestCase;

class ServerRequirementsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function server_requirements_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var ServerRequirementsStep $requirements
         */
        $requirements = app(ServerRequirementsStep::class);

        // Act
        $response = $this->getJson('/api/v1/installation/server/requirements');

        // Assert
        $response->assertOk();
        $this->assertCount(
            $requirements->checks()->count(),
            $response->json('data.validations')
        );
        $requirements
            ->checks()
            ->each(function (Requirement $requirement) use ($response) {
                $response->assertSeeText($requirement->title());
            });
    }

    /**
     * @test
     */
    public function server_requirements_controller_returns_a_resource()
    {
        // Arrange
        $subject = app(ServerRequirementsController::class);

        // Act
        $response = $subject->index();

        // Assert
        $this->assertEquals(
            RequirementResource::class,
            $response->toArray(null)['validations']->collects
        );
    }

    /**
     * @test
     */
    public function server_requirements_controller_apply_will_apply_changes()
    {
        // Arrange
        $step = $this->mock(ServerRequirementsStep::class);
        $this->swap(ServerRequirementsStep::class, $step);

        $step->expects('apply')
            ->once();

        // Act
        $response = $this->putJson(
            route('api.v1.installation.server.requirements.apply')
        );

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function server_requirements_controller_apply_will_return_an_exception_if_it_fails()
    {
        // Arrange
        $step = $this->mock(ServerRequirementsStep::class);
        $this->swap(ServerRequirementsStep::class, $step);

        $step->expects('apply')
            ->once()
            ->andThrow(Exception::class, 'Testing failure');

        // Act
        $response = $this->putJson(
            route('api.v1.installation.server.requirements.apply')
        );

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Testing failure',
        ]);
    }
}
