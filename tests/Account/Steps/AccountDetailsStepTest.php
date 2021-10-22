<?php

namespace GamingEngine\Installation\Tests\Account\Steps;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Repositories\UserRepository;
use GamingEngine\Installation\Account\Steps\AccountDetailsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class AccountDetailsStepTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function account_details_step_identifier()
    {
        // Arrange
        $subject = app(AccountDetailsStep::class);

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
    public function account_details_step_name()
    {
        // Arrange
        $subject = app(AccountDetailsStep::class);
        // Act

        // Assert
        $this->assertEquals(
            __('gaming-engine:installation::requirements.account.configuration.title'),
            $subject->name()
        );
    }

    /**
     * @test
     */
    public function account_details_step_checks_contain_values()
    {
        // Arrange
        $subject = app(AccountDetailsStep::class);

        // Act
        $checks = $subject->checks();

        // Assert
        $this->assertGreaterThan(
            0,
            $checks->count()
        );
    }

    /**
     * @test
     */
    public function account_details_step_combines_data_and_creates_account()
    {
        // Arrange
        Storage::fake();
        $userRepository = $this->mock(UserRepository::class);
        $subject = new AccountDetailsStep($userRepository);

        $details = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $subject->override($details);

        $userRepository->shouldReceive('create')
            ->withArgs(function (UserDTO $actual) use ($details) {
                foreach ($details as $key => $value) {
                    if ($actual->$key !== $value) {
                        return false;
                    }

                    return true;
                }
            });

        // Act
        $subject->apply();

        // Assert
    }
}
