<?php

namespace GamingEngine\Installation\Tests\Http\Controllers;

use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Installation\Tests\TestCase;

class StartControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->mock(ConfigurationRepository::class);
    }

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
