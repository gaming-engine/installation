<?php

namespace GamingEngine\Installation\Tests\Settings\Http\Controllers\Api\V1;

use Exception;
use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Settings\Http\Controllers\Api\V1\LanguageController;
use GamingEngine\Installation\Settings\Http\Requests\Api\V1\LanguageOverrideRequest;
use GamingEngine\Installation\Settings\Http\Resources\Api\V1\LanguageResource;
use GamingEngine\Installation\Settings\Requirements\LanguageConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\LanguageSettings;
use GamingEngine\Installation\Settings\Steps\LanguageSettingsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class LanguageControllerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function language_requirements_override_request()
    {
        $this->assertActionUsesFormRequest(
            LanguageController::class,
            'store',
            LanguageOverrideRequest::class,
        );
    }

    /**
     * @test
     */
    public function language_requirements_returns_a_specific_resource()
    {
        // Arrange
        $subject = app(LanguageController::class);

        // Act
        $response = $subject->index();

        // Assert
        $this->assertInstanceOf(
            LanguageResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function language_requirements_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var LanguageSettingsStep $requirements
         */
        $requirements = app(LanguageSettingsStep::class);

        // Act
        $response = $this->getJson('/api/v1/installation/language/requirements');

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
    public function language_requirements_returns_a_specific_resource_when_overridden()
    {
        // Arrange
        $subject = app(LanguageController::class);
        $request = $this->mock(LanguageOverrideRequest::class);
        $request->shouldReceive('validated')
            ->andReturn([]);

        // Act
        $response = $subject->store($request);

        // Assert
        $this->assertInstanceOf(
            LanguageResource::class,
            $response
        );
    }

    /**
     * @test
     */
    public function language_requirements_controller_will_attempt_to_override_values()
    {
        Storage::fake();

        // Arrange
        /**
         * @var $requirements LanguageSettingsStep
         */
        $requirements = app(LanguageSettingsStep::class);

        $values = $requirements->checks()
            ->first(
                fn (Requirement $requirement) => $requirement instanceof LanguageSettings
            )
            ->components()
            ->keyBy(fn (LanguageConfigurationValue $configurationValue) => $configurationValue->attribute())
            ->map(
                fn (LanguageConfigurationValue $configurationValue) => collect(
                    Arr::random($configurationValue->available(), 1)
                )->first()
            )
            ->toArray();

        // Act
        $response = $this->postJson('/api/v1/installation/language/requirements', $values);

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
    public function language_requirements_controller_apply_will_apply_changes()
    {
        // Arrange
        $step = $this->mock(LanguageSettingsStep::class);
        $this->swap(LanguageSettingsStep::class, $step);

        $step->expects('apply')
            ->once();

        // Act
        $response = $this->putJson(
            route('api.v1.installation.language.requirements.apply')
        );

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function language_requirements_controller_apply_will_return_an_exception_if_it_fails()
    {
        // Arrange
        $step = $this->mock(LanguageSettingsStep::class);
        $this->swap(LanguageSettingsStep::class, $step);

        $step->expects('apply')
            ->once()
            ->andThrow(Exception::class, 'Testing failure');

        // Act
        $response = $this->putJson(
            route('api.v1.installation.language.requirements.apply')
        );

        // Assert
        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Testing failure',
        ]);
    }
}
