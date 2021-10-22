<?php

namespace GamingEngine\Installation\Tests\Requirements;

use GamingEngine\Installation\Requirements\Requirement;
use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Steps\BaseStep;
use GamingEngine\Installation\Tests\TestCase;

class BaseStepTest extends TestCase
{
    /**
     * @test
     */
    public function base_step_is_complete_if_all_tasks_are_done()
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

    /**
     * @test
     */
    public function base_step_flattens_all_requirements()
    {
        // Arrange
        $requirement = $this->mock(Requirement::class);
        $requirement->shouldReceive('components')
            ->andReturn(collect([
                $this->mock(RequirementDetail::class),
                $this->mock(RequirementDetail::class),
            ]));

        $subject = $this->getMockForAbstractClass(
            BaseStep::class
        );

        $subject->expects($this->once())
            ->method('checks')
            ->willReturn(collect([
                $requirement,
                $requirement,
            ]));

        // Act
        $result = $subject->flatten();

        // Assert
        $this->assertCount(4, $result);
    }
}
