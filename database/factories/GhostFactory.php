<?php

namespace Database\Factories;

use App\Models\Ghost;
use Illuminate\Database\Eloquent\Factories\Factory;

class GhostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ghost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 3000),
            'data' => $this->faker->text(100),
        ];
    }
}
