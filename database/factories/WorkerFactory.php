<?php

namespace Database\Factories;

use App\Models\Worker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition(): array
    {
        return [
            'person_id' => User::factory(),
            'date_of_employment' => $this->faker->dateTime(),
            'is_admin' => $this->faker->boolean(),
        ];
    }
}
