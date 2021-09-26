<?php

namespace GamingEngine\Installation\Tests\Requirements\Server\Folder;

use GamingEngine\Installation\Server\Requirements\Folder\FolderExistenceRequirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\File;

class FolderExistenceRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function folder_existence_requirement_check_returns_false_if_folder_doesnt_exist()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnFalse();

        $requirement = new FolderExistenceRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertFalse($exists);
    }

    /**
     * @test
     */
    public function folder_existence_requirement_check_returns_false_if_folder_exists_but_is_a_file()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();
        File::shouldReceive('isDirectory')
            ->withArgs([
                'foo',
            ])
            ->andReturnFalse();

        $requirement = new FolderExistenceRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertFalse($exists);
    }

    /**
     * @test
     */
    public function folder_existence_requirement_check_returns_true_if_folder_exists_and_is_a_directory()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();
        File::shouldReceive('isDirectory')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();

        $requirement = new FolderExistenceRequirement('Foo Path', 'foo');

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
        $requirement = new FolderExistenceRequirement('Foo Path', 'foo');

        // Act

        // Assert
        $this->assertEquals(
            "Foo Path folder must exist (foo).",
            $requirement->description()
        );
    }
}
