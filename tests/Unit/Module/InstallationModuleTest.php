<?php

namespace GamingEngine\Installation\Tests\Unit\Module;

use GamingEngine\Installation\Module\InstallationModule;
use PHPUnit\Framework\TestCase;

class InstallationModuleTest extends TestCase
{
    /**
     * @test
     */
    public function installation_module_provides_the_correct_version()
    {
        // Arrange
        $subject = new InstallationModule();

        // Act

        // Assert
        $this->assertEquals(
            InstallationModule::VERSION,
            $subject->version()
        );
    }

    /**
     * @test
     */
    public function installation_module_provides_the_correct_ame()
    {
        // Arrange
        $subject = new InstallationModule();

        // Act

        // Assert
        $this->assertEquals(
            'gaming-engine:installation',
            $subject->name()
        );
    }
}
