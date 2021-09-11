<?php

namespace GamingEngine\Installation\Tests\Steps\ServerRequirements\FileRequirements;

use GamingEngine\Installation\Steps\ServerRequirements\FileRequirements\FileExistenceRequirement;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Support\Facades\File;

class FileExistenceRequirementTest extends TestCase
{
    /**
     * @test
     */
    public function file_existence_requirement_check_returns_false_if_folder_doesnt_exist()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnFalse();

        $requirement = new FileExistenceRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertFalse($exists);
    }

    /**
     * @test
     */
    public function file_existence_requirement_check_returns_false_if_file_exists_but_is_not_a_file()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();
        File::shouldReceive('isFile')
            ->withArgs([
                'foo',
            ])
            ->andReturnFalse();

        $requirement = new FileExistenceRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertFalse($exists);
    }

    /**
     * @test
     */
    public function file_existence_requirement_check_returns_true_if_file_exists_and_is_a_file()
    {
        // Arrange
        File::shouldReceive('exists')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();
        File::shouldReceive('isFile')
            ->withArgs([
                'foo',
            ])
            ->andReturnTrue();

        $requirement = new FileExistenceRequirement('Foo Path', 'foo');

        // Act
        $exists = $requirement->check();

        // Assert
        $this->assertTrue($exists);
    }

    /**
     * @test
     */
    public function file_existence_requirement_description()
    {
        // Arrange
        $requirement = new FileExistenceRequirement('Foo Path', 'foo');

        // Act

        // Assert
        $this->assertEquals(
            "Foo Path file must exist (foo).",
            $requirement->description()
        );
    }
}
