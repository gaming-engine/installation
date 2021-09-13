<?php

namespace GamingEngine\Installation\Tests\Requirements\Server;

use GamingEngine\Installation\Requirements\Server\FileRequirements;
use GamingEngine\Installation\Tests\TestCase;

class FileRequirementsTest extends TestCase
{
    /**
     * @test
     */
    public function file_requirements_can_get_the_name()
    {
        // Arrange
        $subject = new FileRequirements();

        // Act

        // Assert
        $this->assertEquals(
            'File Requirements',
            $subject->name()
        );
    }

    /**
     * @test
     */
    public function file_requirements_check_lists_default_requirements()
    {
        // Arrange
        $subject = new FileRequirements();

        // Act

        // Assert
        $this->assertGreaterThan(
            1,
            count($subject->checks())
        );
    }
}
