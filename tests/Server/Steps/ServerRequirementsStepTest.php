<?php

namespace GamingEngine\Installation\Tests\Server\Steps;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Server\Steps\ServerRequirementsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ServerRequirementsStepTest extends TestCase
{
    /**
     * @test
     */
    public function server_requirements_is_incomplete_if_any_task_is_not_done()
    {
        // Arrange
        $requirement = $this->mock(Requirement::class);
        $requirement->shouldReceive('check')
            ->andReturnFalse();

        $subject = new ServerRequirementsStep();

        // Act
        $result = $subject->isComplete();

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function server_requirements_has_a_list_of_requirements()
    {
        // Arrange
        $subject = new ServerRequirementsStep();

        // Act
        $count = $subject->checks()->count();

        // Assert
        $this->assertGreaterThan(0, $count);
    }

    /**
     * @test
     */
    public function server_requirements_step_apply_will_make_the_linked_storage()
    {
        // Arrange
        Artisan::shouldReceive('call')
            ->withArgs(fn ($command) => 'storage:link' === $command);

        Artisan::shouldReceive('call')
            ->withArgs(fn ($command) => 'vendor:publish' === $command);

        $subject = new ServerRequirementsStep();

        // Act
        $subject->apply();

        // Assert
    }
}
