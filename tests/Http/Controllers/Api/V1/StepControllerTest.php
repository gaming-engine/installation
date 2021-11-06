<?php

namespace GamingEngine\Installation\Tests\Http\Api\V1\Controllers;

use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Installation\Http\Controllers\Api\V1\StepController;
use GamingEngine\Installation\Http\Resources\Api\V1\Steps\StepResource;
use GamingEngine\Installation\Steps\Step;
use GamingEngine\Installation\Steps\StepCollection;
use GamingEngine\Installation\Tests\TestCase;

class StepControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(ConfigurationRepository::class);
    }

    /**
     * @test
     */
    public function step_controller_is_able_to_return_all_steps()
    {
        // Arrange
        /**
         * @var StepCollection $stepCollection
         */
        $stepCollection = app(StepCollection::class);

        // Act
        $response = $this->getJson(
            '/api/v1/installation/steps'
        );

        // Assert
        $response->assertOk();
        $this->assertCount(
            $stepCollection->count(),
            $response->json('data')
        );
        $stepCollection
            ->all()
            ->each(function (Step $step) use ($response) {
                $response->assertSeeText($step->identifier());
            });
    }

    /**
     * @test
     */
    public function step_controller_returns_a_resource()
    {
        // Arrange
        $subject = app(StepController::class);

        // Act
        $response = $subject();

        // Assert
        $this->assertEquals(
            StepResource::class,
            $response->collects
        );
    }
}
