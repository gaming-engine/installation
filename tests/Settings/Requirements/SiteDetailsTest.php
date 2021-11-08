<?php

namespace GamingEngine\Installation\Tests\Settings\Requirements;

use GamingEngine\Installation\Requirements\RequirementDetail;
use GamingEngine\Installation\Settings\Requirements\SiteConfigurationValue;
use GamingEngine\Installation\Settings\Requirements\SiteDetails;
use GamingEngine\Installation\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class SiteDetailsTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function site_details_requirements_name()
    {
        // Arrange
        $subject = app(SiteDetails::class);

        // Act
        $name = $subject->title();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.site.title"),
            $name
        );
    }

    /**
     * @test
     */
    public function site_details_requirements_description()
    {
        // Arrange
        $subject = app(SiteDetails::class);

        // Act
        $name = $subject->description();

        // Assert
        $this->assertEquals(
            __("gaming-engine:installation::requirements.settings.site.description"),
            $name
        );
    }

    /**
     * @test
     */
    public function site_details_requirements_identifier()
    {
        // Arrange
        $subject = app(SiteDetails::class);

        // Act

        // Assert
        $this->assertEquals(
            'configuration',
            $subject->identifier()
        );
    }

    /**
     * @test
     */
    public function site_details_requirements_has_components()
    {
        // Arrange
        $subject = app(SiteDetails::class);

        // Act
        $response = $subject->components();

        // Assert
        $this->assertGreaterThan(
            0,
            $response->count()
        );
    }

    /**
     * @test
     */
    public function site_details_requirements_overrides_are_applied()
    {
        // Arrange
        $subject = new SiteDetails(app(Request::class), [
            'name' => $name = $this->faker->name,
        ]);

        // Act
        $response = $subject->components()
            ->first(fn (SiteConfigurationValue $value) => $value->attribute() === 'name');

        // Assert
        $this->assertNotNull($response);
        $this->assertEquals(
            $name,
            $response->value()
        );
    }

    /**
     * @test
     */
    public function site_details_requirements_check_returns_false_if_some_are_incomplete()
    {
        // Arrange
        $subject = $this->createStub(
            SiteDetails::class,
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnFalse();

        // Act
        $response = $subject->check();

        // Assert
        $this->assertFalse($response);
    }

    /**
     * @test
     */
    public function site_details_requirements_check_returns_true_if_some_are_complete()
    {
        // Arrange
        $subject = $this->createPartialMock(
            SiteDetails::class,
            [
                'components',
            ]
        );

        $subject->method('components')
            ->willReturn(collect([
                $requirement = $this->mock(RequirementDetail::class),
            ]));

        $requirement->shouldReceive('check')
            ->andReturnTrue();

        // Act
        $response = $subject->check();

        // Assert
        $this->assertTrue($response);
    }
}
