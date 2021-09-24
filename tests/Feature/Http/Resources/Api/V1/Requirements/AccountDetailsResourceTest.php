<?php

namespace GamingEngine\Installation\Tests\Feature\Api\V1\Requirements;

use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\AccountDetailsResource;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\ConfigurationResource;
use GamingEngine\Installation\Http\Resources\Api\V1\Requirements\RequirementResource;
use GamingEngine\Installation\Requirements\Account\AccountConfigurationRequirements;
use GamingEngine\Installation\Steps\AccountDetailsStep;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountDetailsResourceTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function account_details_resource_contract()
    {
        // Arrange

        $requirements = $this->mock(AccountConfigurationRequirements::class);
        $requirements->shouldReceive('components')
            ->andReturn(collect());

        $resource = $this->mock(AccountDetailsStep::class);

        $resource->shouldReceive('checks')
            ->andReturn(collect([
                $requirements,
            ]));

        $requirements->shouldReceive('identifier')
            ->andReturn($this->faker->slug);

        $subject = new AccountDetailsResource($resource);

        // Act
        $response = $subject->toArray(null);

        // Assert
        $this->assertTrue(
            array_key_exists('validations', $response)
        );

        $this->assertTrue(
            array_key_exists('configurations', $response)
        );

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response['validations']);
        $this->assertEquals(RequirementResource::class, $response['validations']->collects);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response['configurations']);
        $this->assertEquals(ConfigurationResource::class, $response['configurations']->collects);
    }
}
