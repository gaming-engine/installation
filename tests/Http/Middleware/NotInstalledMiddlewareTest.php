<?php

namespace GamingEngine\Installation\Tests\Http\Middleware;

use GamingEngine\Core\Framework\Installation\CoreInstallationVerification;
use GamingEngine\Installation\Http\Middleware\NotInstalledMiddleware;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Http\Request;

class NotInstalledMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function not_installed_middleware_will_redirect_to_homepage_if_installed()
    {
        // Arrange
        $subject = new NotInstalledMiddleware(
            $verification = $this->mock(CoreInstallationVerification::class)
        );

        $verification->shouldReceive('installed')
            ->andReturnTrue();

        // Act
        $response = $subject->handle(
            $this->mock(Request::class),
            fn ($request) => null
        );

        // Assert
        $this->assertEquals(
            302,
            $response->getStatusCode()
        );
        $this->assertEquals(
            'http://localhost',
            $response->getTargetUrl()
        );
    }

    /**
     * @test
     */
    public function not_installed_middleware_will_let_you_access_the_installer_if_not_installed()
    {
        // Arrange
        $called = false;
        $subject = new NotInstalledMiddleware(
            $verification = $this->mock(CoreInstallationVerification::class)
        );

        $verification->shouldReceive('installed')
            ->andReturnFalse();

        // Act
        $subject->handle(
            $this->mock(Request::class),
            function () use (&$called) {
                $called = true;
            }
        );

        // Assert
        $this->assertTrue($called);
    }
}
