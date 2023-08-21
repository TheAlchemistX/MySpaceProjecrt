<?php

namespace Database\Factories;

use App\Models\SpaceJob;
use App\Models\task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpaceJob>
 */
class taskFactory extends Factory
{
    protected $model = task::class;

    public function definition(): array
    {
        return [
            "name"=> $this->faker->title,
            "timer"=> $this->faker->dateTime,
            "job_id"=>SpaceJob::get()->random()->id
        ];
    }
}
