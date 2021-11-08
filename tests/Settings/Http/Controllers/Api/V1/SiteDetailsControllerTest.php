<?php

namespace GamingEngine\Installation\Tests\Settings\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Settings\Http\Controllers\Api\V1\SiteDetailsController;
use GamingEngine\Installation\Settings\Http\Requests\Api\V1\SiteDetailsOverrideRequest;
use GamingEngine\Installation\Settings\Http\Resources\Api\V1\SiteDetailsResource;
use GamingEngine\Installation\Settings\Steps\SiteDetailsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class SiteDetailsControllerTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->mock(ConfigurationRepository::class);
    }

    /**
     * @test
     */
    public function site_details_override_request()
    {
        $this->assertActionUsesFormRequest(
            SiteDetailsController::class,
            'store',
            SiteDetailsOverrideRequest::class,
        );
    }

    /**
     * @test
     */
    public function site_details_returns_a_specific_resource()
    {
        // Arrange
        $subject = app(SiteDetailsController::class);

        // Act
        $response = $subject->index();

        // Assert
        $this->assertInstanceOf(
            SiteDetailsResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function site_details_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var SiteDetailsStep $requirements
         */
        $requirements = app(SiteDetailsStep::class);

        // Act
        $response = $this->getJson('/api/v1/installation/site-details/requirements');

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
    public function site_details_returns_a_specific_resource_when_overridden()
    {
        // Arrange
        $subject = app(SiteDetailsController::class);
        $request = $this->mock(SiteDetailsOverrideRequest::class);
        $request->shouldReceive('validated')
            ->andReturn([]);

        // Act
        $response = $subject->store($request);

        // Assert
        $this->assertInstanceOf(
            SiteDetailsResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function site_details_controller_will_attempt_to_override_values()
    {
        Storage::fake();

        // Arrange
        /**
         * @var $requirements SiteDetailsStep
         */
        $requirements = app(SiteDetailsStep::class);

        // Act
        $response = $this->postJson('/api/v1/installation/site-details/requirements', [
            'name' => $this->faker->name,
            'domain' => $this->faker->domainName,
        ]);

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
    public function site_details_controller_apply_will_apply_changes()
    {
        // Arrange
        $step = $this->mock(SiteDetailsStep::class);
        $this->swap(SiteDetailsStep::class, $step);

        $step->expects('apply')
            ->once();

        // Act
        $response = $this->putJson(
            route('api.v1.installation.site-details.requirements.apply')
        );

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function site_details_controller_apply_will_return_an_exception_if_it_fails()
    {
        // Arrange
        $step = $this->mock(SiteDetailsStep::class);

        $step->expects('apply')
            ->once()
            ->andThrow(Exception::class, 'Testing failure');

        // Act
        $response = $this->putJson(
            route('api.v1.installation.site-details.requirements.apply')
        );

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Testing failure',
        ]);
    }
}
