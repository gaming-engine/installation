<?php

namespace GamingEngine\Installation\Tests\Feature\Requirements\Server;

use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Requirements\Server\BaseServerRequirement;
use GamingEngine\Installation\Tests\TestCase;

class BaseServerRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function base_server_requirement_returns_true_if_all_requirements_are_complete()
    {
        // Arrange
        $requirement = $this->mock(RequirementDetail::class);
        $requirement->shouldReceive('check')
            ->andReturnTrue();

        $requirements = [
            $requirement,
        ];

        $subject = $this->getMockForAbstractClass(
            BaseServerRequirement::class,
        );

        $subject->method('checks')
            ->willReturn($requirements);

        // Act

        // Assert
        $this->assertTrue($subject->check());
    }

    /**
     * @test
     */
    public function base_server_requirement_returns_false_if_one_requirement_is_incomplete()
    {
        // Arrange
        $complete = $this->mock(RequirementDetail::class);
        $complete->shouldReceive('check')
            ->andReturnTrue();

        $incomplete = $this->mock(RequirementDetail::class);
        $incomplete->shouldReceive('check')
            ->andReturnFalse();

        $requirements = [
            $complete,
            $incomplete,
        ];

        $subject = $this->getMockForAbstractClass(
            BaseServerRequirement::class,
        );

        $subject->method('checks')
            ->willReturn($requirements);

        // Act

        // Assert
        $this->assertFalse($subject->check());
    }
}
