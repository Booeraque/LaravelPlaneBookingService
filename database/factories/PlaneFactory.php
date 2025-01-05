<?php

namespace Database\Factories;

use App\Models\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaneFactory extends Factory
{
    protected $model = Plane::class;

    public function definition(): array
    {
        return [
            'plane_name' => $this->faker->word(),
            'model' => $this->faker->word(),
            'capacity' => $this->faker->numberBetween(50, 300),
            'speed' => $this->faker->numberBetween(500, 1000),
            'status' => 'available',
            ];
    }
}
