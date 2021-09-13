<?php

namespace GamingEngine\Installation\Tests\Feature\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Steps\BaseStep;
use GamingEngine\Installation\Tests\TestCase;

class BaseStepTest extends TestCase
{
    /**
     * @test
     */
    public function server_requirements_is_complete_if_all_tasks_are_done()
    {
        // Arrange
        $requirement = $this->mock(Requirement::class);
        $requirement->shouldReceive('check')
            ->andReturnTrue();

        $subject = $this->getMockForAbstractClass(
            BaseStep::class
        );

        $subject->expects($this->once())
            ->method('checks')
            ->willReturn(collect([
                $requirement,
            ]));

        // Act
        $result = $subject->isComplete();

        // Assert
        $this->assertTrue($result);
    }
}
