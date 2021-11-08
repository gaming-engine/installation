<?php

namespace GamingEngine\Installation\Tests\Server\Requirements;

use GamingEngine\Installation\Server\Requirements\FolderRequirements;
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
            $subject->title()
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
