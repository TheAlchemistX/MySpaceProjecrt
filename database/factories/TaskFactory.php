<?php

namespace Database\Factories;

use App\Models\SpaceJob;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpaceJob>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            "name"=> $this->faker->title,
            "timer"=> $this->faker->dateTime,
            "job_id"=>SpaceJob::get()->random()->id
        ];
    }
}
