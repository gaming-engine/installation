<?php

namespace GamingEngine\Installation\Tests\Unit\Helpers\PHP;

use GamingEngine\Installation\Helpers\PHP\PHPDetails;
use GamingEngine\Installation\Tests\TestCase;

class PHPDetailsTest extends TestCase
{
    /**
     * @test
     */
    public function php_details_version_provides_the_correct_version_of_php()
    {
        // Arrange
        $details = new PHPDetails();

        // Act
        $version = $details->version();

        // Assert
        $this->assertEquals(
            phpversion(),
            $version
        );
    }

    /**
     * @test
     */
    public function php_details_hasExtension_provides_that_the_extension_is_installed()
    {
        // Arrange
        $details = new PHPDetails();

        // Act
        $exists = $details->hasExtension('pdo');

        // Assert
        $this->assertTrue($exists);
    }

    /**
     * @test
     */
    public function php_details_hasExtension_provides_that_an_invalid_extension_is_not_installed()
    {
        // Arrange
        $details = new PHPDetails();

        // Act
        $exists = $details->hasExtension('asdf123');

        // Assert
        $this->assertFalse($exists);
    }
}
