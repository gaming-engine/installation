<?php

namespace GamingEngine\Installation\Tests\Install\Http\Controllers\Api\V1;

use GamingEngine\Installation\Install\Steps\FinalizeStep;
use GamingEngine\Installation\Tests\TestCase;

class FinalizeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function finalize_controller_index()
    {
        // Arrange

        // Act
        $response = $this->getJson(
            route('api.v1.installation.finalize.requirements')
        );

        // Assert
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function finalize_controller_apply()
    {
        // Arrange
        $step = $this->mock(FinalizeStep::class);
        $step->shouldReceive('apply')
            ->once();

        // Act
        $response = $this->putJson(
            route('api.v1.installation.finalize.requirements.apply')
        );

        // Assert
        $response->assertSuccessful();
    }
}
