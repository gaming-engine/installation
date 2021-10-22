<?php

namespace GamingEngine\Installation\Tests;

use GamingEngine\Core\Account\Providers\UserServiceProvider;
use GamingEngine\Core\CoreServiceProvider;
use GamingEngine\Installation\InstallationServiceProvider;
use GamingEngine\Installation\Providers\RouteServiceProvider;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use JMac\Testing\Traits\AdditionalAssertions;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use AdditionalAssertions;

    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => Str::of($modelName)
                    ->replace(
                        'GamingEngine\\Installer\\',
                        'GamingEngine\\Installer\\Database\\Factories\\'
                    )
                    ->replace('\\Models\\', '\\')
                . 'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            UserServiceProvider::class,
            InstallationServiceProvider::class,
            RouteServiceProvider::class,
        ];
    }

    protected function fakeValidator(): Validator
    {
        $validator = $this->mock(Validator::class);
        $factory = $this->mock(ValidationFactory::class);
        $factory->shouldReceive('make')
            ->andReturn($validator);
        $validator->shouldReceive('stopOnFirstFailure')
            ->andReturnSelf();
        $validator->shouldReceive('fails')
            ->andReturnFalse();

        return $validator;
    }
}
