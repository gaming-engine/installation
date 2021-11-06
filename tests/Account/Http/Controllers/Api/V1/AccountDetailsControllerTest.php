<?php

namespace GamingEngine\Installation\Tests\Account\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Account\Http\Controllers\Api\V1\AccountDetailsController;
use GamingEngine\Installation\Account\Http\Requests\Api\V1\OverrideRequest;
use GamingEngine\Installation\Account\Http\Resources\Api\V1\AccountDetailsResource;
use GamingEngine\Installation\Account\Requirements\AccountConfigurationRequirements;
use GamingEngine\Installation\Account\Requirements\AccountConfigurationValue;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class AccountDetailsControllerTest extends TestCase
{
    use  WithFaker;

    /**
     * @test
     */
    public function account_details_override_request()
    {
        $this->assertActionUsesFormRequest(
            AccountDetailsController::class,
            'store',
            OverrideRequest::class,
        );
    }

    /**
     * @test
     */
    public function account_details_returns_a_specific_resource()
    {
        // Arrange
        $subject = app(AccountDetailsController::class);

        // Act
        $response = $subject->index();

        // Assert
        $this->assertInstanceOf(
            AccountDetailsResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function account_details_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var AccountDetailsStep $requirements
         */
        $requirements = app(AccountDetailsStep::class);

        // Act
        $response = $this->getJson('/api/v1/installation/account/requirements');

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
    public function account_details_returns_a_specific_resource_when_overridden()
    {
        // Arrange
        $subject = app(AccountDetailsController::class);
        $request = $this->mock(OverrideRequest::class);
        $request->shouldReceive('validated')
            ->andReturn([]);

        // Act
        $response = $subject->store($request);

        // Assert
        $this->assertInstanceOf(
            AccountDetailsResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function account_details_controller_will_attempt_to_override_values()
    {
        // Arrange
        Storage::fake();

        /**
         * @var $requirements AccountDetailsStep
         */
        $requirements = app(AccountDetailsStep::class);

        $values = $requirements->checks()
            ->first(
                fn (Requirement $requirement) => $requirement instanceof AccountConfigurationRequirements
            )
            ->components()
            ->keyBy(fn (AccountConfigurationValue $configurationValue) => $configurationValue->attribute())
            ->map(fn (AccountConfigurationValue $configurationValue) => $this->faker->slug)
            ->toArray();

        // Act
        $response = $this->postJson('/api/v1/installation/account/requirements', $values);

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
    public function account_details_controller_apply_will_apply_changes()
    {
        // Arrange
        $step = $this->mock(AccountDetailsStep::class);
        $this->swap(AccountDetailsStep::class, $step);

        $step->expects('apply')
            ->once();

        // Act
        $response = $this->putJson(
            route('api.v1.installation.account.requirements.apply')
        );

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function account_details_controller_apply_will_return_an_exception_if_it_fails()
    {
        // Arrange
        $step = $this->mock(AccountDetailsStep::class);
        $this->swap(AccountDetailsStep::class, $step);

        $step->expects('apply')
            ->once()
            ->andThrow(Exception::class, 'Testing failure');

        // Act
        $response = $this->putJson(
            route('api.v1.installation.account.requirements.apply')
        );

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Testing failure',
        ]);
    }
}
