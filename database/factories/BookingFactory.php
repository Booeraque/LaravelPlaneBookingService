<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\ShoppingCart;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'cart_id' => ShoppingCart::factory(),
            'worker_id' => Worker::factory(),
            'booking_date' => $this->faker->dateTime(),
            'additional_comments' => $this->faker->sentence(),
        ];
    }
}
