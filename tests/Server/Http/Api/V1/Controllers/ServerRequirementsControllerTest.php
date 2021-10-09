<?php

namespace GamingEngine\Installation\Tests\Server\Http\Api\V1\Controllers;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Http\Api\V1\Controllers\ServerRequirementsController;
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
                $response->assertSeeText($requirement->name());
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
        $response = $subject();

        // Assert
        $this->assertEquals(
            RequirementResource::class,
            $response->toArray(null)['validations']->collects
        );
    }
}
