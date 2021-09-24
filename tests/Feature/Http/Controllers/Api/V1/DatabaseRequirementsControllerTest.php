<?php

namespace GamingEngine\Installation\Tests\Feature\Http\Api\V1\Controllers;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Http\Controllers\Api\V1\DatabaseRequirementsController;
use GamingEngine\Installation\Http\Requests\Api\V1\DatabaseRequirements\OverrideRequest;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\DatabaseRequirementResource;
use GamingEngine\Installation\Requirements\Database\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Requirements\Database\DatabaseConfigurationValue;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class DatabaseRequirementsControllerTest extends TestCase
{
    use  WithFaker;

    /**
     * @test
     */
    public function database_requirements_override_request()
    {
        $this->assertActionUsesFormRequest(
            DatabaseRequirementsController::class,
            'store',
            OverrideRequest::class,
        );
    }

    /**
     * @test
     */
    public function database_requirements_returns_a_specific_resource()
    {
        // Arrange
        $subject = app(DatabaseRequirementsController::class);

        // Act
        $response = $subject->index();

        // Assert
        $this->assertInstanceOf(
            DatabaseRequirementResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function database_requirements_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var DatabaseRequirementsStep $requirements
         */
        $requirements = app(DatabaseRequirementsStep::class);

        // Act
        $response = $this->getJson(
            '/api/v1/installation/requirements/database'
        );

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
    public function database_requirements_returns_a_specific_resource_when_overridden()
    {
        // Arrange
        $subject = app(DatabaseRequirementsController::class);
        $request = $this->mock(OverrideRequest::class);
        $request->shouldReceive('validated')
            ->andReturn([]);

        // Act
        $response = $subject->store($request);

        // Assert
        $this->assertInstanceOf(
            DatabaseRequirementResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function database_requirements_controller_will_attempt_to_override_values()
    {
        // Arrange
        Storage::fake();

        /**
         * @var $requirements DatabaseRequirementsStep
         */
        $requirements = app(DatabaseRequirementsStep::class);

        $values = $requirements->checks()
            ->first(
                fn (Requirement $requirement) => $requirement instanceof DatabaseConfigurationRequirements
            )
            ->components()
            ->keyBy(fn (DatabaseConfigurationValue $configurationValue) => $configurationValue->attribute())
            ->map(fn (DatabaseConfigurationValue $configurationValue) => $this->faker->slug)
            ->toArray();

        $this->mock(ChecksDatabaseConnection::class)
            ->shouldReceive('test')
            ->withArgs(function ($arguments) use ($values) {
                foreach ($values as $key => $value) {
                    if ($arguments->$key !== $value) {
                        return false;
                    }
                }

                return true;
            })
            ->andReturnTrue();

        // Act
        $response = $this->postJson(
            '/api/v1/installation/requirements/database',
            $values
        );

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
}
