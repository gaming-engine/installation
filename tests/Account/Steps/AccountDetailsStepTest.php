<?php

namespace GamingEngine\Installation\Tests\Account\Steps;

use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use GamingEngine\Installation\Tests\TestCase;

class AccountDetailsStepTest extends TestCase
{
    /**
     * @test
     */
    public function account_details_step_identifier()
    {
        // Arrange
        $subject = new AccountDetailsStep();

        // Act

        // Assert
        $this->assertEquals(
            'account',
            $subject->identifier(),
        );
    }

    /**
     * @test
     */
    public function settings_step_name()
    {
        // Arrange
        $subject = new AccountDetailsStep();

        // Act

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.account.configuration.name'),
            $subject->name()
        );
    }

    /**
     * @test
     */
    public function settings_step_checks_contain_values()
    {
        // Arrange
        $subject = new AccountDetailsStep();

        // Act
        $checks = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $checks->count()
        );
    }
}
