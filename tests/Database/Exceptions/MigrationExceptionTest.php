<?php

namespace GamingEngine\Installation\Tests\Database\Exceptions;

use GamingEngine\Installation\Database\Exceptions\MigrationException;
use GamingEngine\Installation\Tests\TestCase;

class MigrationExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function migration_exception_message()
    {
        // Arrange
        $subject = new MigrationException('Hello World');

        // Act
        $message = $subject->getMessage();

        // Assert
        $this->assertEquals(
            'When trying to set up the database, the following error message was received: Hello World',
            $message
        );
    }
}
