<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentences(1, true),
	        'priority' => 1
        ];
    }
	
	public function setRandomPriority(): TaskFactory
	{
		return $this->state(function($attributes) {
			return [
				'priority' => random_int(1, 100)
			];
		});
	}
}
