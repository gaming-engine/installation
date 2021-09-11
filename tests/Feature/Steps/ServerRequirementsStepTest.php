<?php

namespace GamingEngine\Installation\Tests\Feature\Steps;

use GamingEngine\Installation\Steps\Requirement;
use GamingEngine\Installation\Steps\ServerRequirementsStep;
use GamingEngine\Installation\Tests\TestCase;

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
}
