<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->title,
            'description'=>$this->faker->text,
            'user_id'=>User::get()->random()->id
        ];
    }
}
