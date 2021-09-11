<?php

namespace GamingEngine\Installation\Tests\Feature\Steps;

use GamingEngine\Installation\Steps\Step;
use GamingEngine\Installation\Steps\StepCollection;
use GamingEngine\Installation\Tests\TestCase;

class StepCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function step_collection_is_able_to_return_all_steps_provided()
    {
        // Arrange
        $steps = [
            $this->mock(Step::class),
        ];
        $collection = new StepCollection($steps);

        // Act
        $result = $collection->all();

        // Assert
        $this->assertEquals($steps, $result->toArray());
    }

    /**
     * @test
     */
    public function step_collection_can_find_the_next_available_step()
    {
        // Arrange
        $complete = $this->mock(Step::class);
        $complete->shouldReceive('isComplete')
            ->andReturnTrue();
        $incomplete = $this->mock(Step::class);
        $incomplete->shouldReceive('isComplete')
            ->andReturnFalse();

        $steps = [
            $complete,
            $incomplete,
        ];

        $collection = new StepCollection($steps);

        // Act
        $result = $collection->next();

        // Assert
        $this->assertEquals($incomplete, $result);
    }

    /**
     * @test
     */
    public function step_collection_returns_null_for_next_when_there_is_nothing_outstanding()
    {
        // Arrange
        $complete = $this->mock(Step::class);
        $complete->shouldReceive('isComplete')
            ->andReturnTrue();
        $incomplete = $this->mock(Step::class);
        $incomplete->shouldReceive('isComplete')
            ->andReturnTrue();

        $steps = [
            $complete,
            $incomplete,
        ];

        $collection = new StepCollection($steps);

        // Act
        $result = $collection->next();

        // Assert
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function step_collection_next_is_able_to_return_the_first_value()
    {
        // Arrange
        $first = $this->mock(Step::class);
        $first->shouldReceive('isComplete')
            ->andReturnFalse();
        $second = $this->mock(Step::class);
        $second->shouldReceive('isComplete')
            ->andReturnFalse();

        $steps = [
            $first,
            $second,
        ];

        $collection = new StepCollection($steps);

        // Act
        $result = $collection->next();

        // Assert
        $this->assertEquals($first, $result);
    }

    /**
     * @test
     */
    public function step_collection_can_determine_the_total_number()
    {
        // Arrange
        $subject = new StepCollection([
            $this->mock(Step::class),
        ]);

        // Act
        $total = $subject->count();

        // Assert
        $this->assertEquals(1, $total);
    }
}
