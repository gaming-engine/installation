<?php

namespace GamingEngine\Installation\Tests\Feature\Steps;

use GamingEngine\Installation\Steps\BaseRequirement;
use GamingEngine\Installation\Steps\RequirementDetail;
use GamingEngine\Installation\Tests\TestCase;

class BaseRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function base_requirement_returns_true_if_all_details_pass()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            BaseRequirement::class
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnTrue();

        // Act
        $result = $subject->check();

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function base_requirement_returns_false_if_all_details_fail()
    {
        // Arrange
        $subject = $this->getMockForAbstractClass(
            BaseRequirement::class
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnFalse();

        // Act
        $result = $subject->check();

        // Assert
        $this->assertFalse($result);
    }
}
