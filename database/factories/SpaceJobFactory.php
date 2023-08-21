<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\SpaceJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpaceJob>
 */
class SpaceJobFactory extends Factory
{
    protected $model = SpaceJob::class;

    public function definition(): array
    {
        return [
            "name"=> $this->faker->title,
            "desctiption"=> $this->faker->text,
            "status"=> "Не выполнена",
            "date_create"=> $this->faker->dateTime,
            "date_finist"=> $this->faker->dateTime,
            "file"=> $this->faker->text,
            "space_id"=>Space::get()->random()->id
        ];
    }
}
