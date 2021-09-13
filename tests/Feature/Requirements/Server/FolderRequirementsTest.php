<?php

namespace GamingEngine\Installation\Tests\Requirements\Server;

use GamingEngine\Installation\Requirements\Server\FolderRequirements;
use GamingEngine\Installation\Tests\TestCase;

class FolderRequirementsTest extends TestCase
{
    /**
     * @test
     */
    public function folder_requirements_can_get_the_name()
    {
        // Arrange
        $subject = new FolderRequirements();

        // Act

        // Assert
        $this->assertEquals(
            'Folder Requirements',
            $subject->name()
        );
    }

    /**
     * @test
     */
    public function folder_requirements_check_lists_default_requirements()
    {
        // Arrange
        $subject = new FolderRequirements();

        // Act

        // Assert
        $this->assertGreaterThan(
            1,
            count($subject->checks())
        );
    }
}