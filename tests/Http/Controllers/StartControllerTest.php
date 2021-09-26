<?php

namespace GamingEngine\Installation\Tests\Http\Controllers;

use GamingEngine\Installation\Tests\TestCase;

class StartControllerTest extends TestCase
{
    /**
     * @test
     */
    public function start_controller_shows_the_installation_page()
    {
        // Arrange
        $this->withoutMix();

        // Act
        $response = $this->get(route('install.index'));

        // Assert
        $response->assertSuccessful();
    }
}
