<?php

namespace GamingEngine\Installation\Tests\Requirements\Server\Folder;

use GamingEngine\Installation\Requirements\Server\Folder\WritableFolderRequirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\File;

class WritableFolderRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function writable_folder_requirement_check_returns_false_if_folder_is_not_writable()
    {
        // Arrange
        File::shouldReceive('isWritable')
            ->withArgs([
                'foo',
            ])
            ->andReturnFalse();

        $requirement = new WritableFolderRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertFalse($exists);
    }

    /**
     * @test
     */
    public function writable_folder_requirement_check_returns_true_if_folder_is_writable()
    {
        // Arrange
        File::shouldReceive('isWritable')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();

        $requirement = new WritableFolderRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertTrue($exists);
    }

    /**
     * @test
     */
    public function folder_existence_requirement_description()
    {
        // Arrange
        $requirement = new WritableFolderRequirement('Foo Path', 'foo');

        // Act

        // Assert
        $this->assertEquals(
            "Foo Path folder must be writable (foo).",
            $requirement->description()
        );
    }
}
