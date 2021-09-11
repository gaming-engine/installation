<?php

namespace GamingEngine\Installation\Tests\Feature\Http\Api\V1\Controllers;

use GamingEngine\Installation\Http\Controllers\Api\V1\ServerRequirementsController;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Steps\Requirement;
use GamingEngine\Installation\Steps\ServerRequirementsStep;
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
        $response = $this->getJson(
            '/api/v1/installation/requirements/server'
        );

        // Assert
        $response->assertOk();
        $this->assertCount(
            $requirements->checks()->count(),
            $response->json('data')
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
            $response->collects
        );
    }
}
