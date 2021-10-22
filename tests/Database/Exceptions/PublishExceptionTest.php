<?php

namespace GamingEngine\Installation\Tests\Database\Exceptions;

use GamingEngine\Installation\Database\Exceptions\PublishException;
use GamingEngine\Installation\Tests\TestCase;

class PublishExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function publish_exception_message()
    {
        // Arrange
        $subject = new PublishException('Hello World');

        // Act
        $message = $subject->getMessage();

        // Assert
        $this->assertEquals(
            'When attempting to publish the database migrations (how we build the database), we received the'
            . ' following error message: Hello World',
            $message
        );
    }
}
