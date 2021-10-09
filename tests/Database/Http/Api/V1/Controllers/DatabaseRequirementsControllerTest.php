<?php

namespace GamingEngine\Installation\Tests\Database\Http\Api\V1\Controllers;

use GamingEngine\Installation\Database\ChecksDatabaseConnection;
use GamingEngine\Installation\Database\Http\Api\V1\Controllers\DatabaseRequirementsController;
use GamingEngine\Installation\Database\Http\Api\V1\Requests\OverrideRequest;
use GamingEngine\Installation\Database\Http\Api\V1\Resources\DatabaseRequirementResource;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationRequirements;
use GamingEngine\Installation\Database\Requirements\DatabaseConfigurationValue;
use GamingEngine\Installation\Database\Steps\DatabaseRequirementsStep;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class DatabaseRequirementsControllerTest extends TestCase
{
    use WithFaker;

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
        $response = $this->getJson('/api/v1/installation/database/requirements');

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
        $response = $this->postJson('/api/v1/installation/database/requirements', $values);

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
