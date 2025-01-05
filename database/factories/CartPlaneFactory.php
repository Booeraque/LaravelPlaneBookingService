<?php

namespace Database\Factories;

use App\Models\CartPlane;
use App\Models\ShoppingCart;
use App\Models\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartPlaneFactory extends Factory
{
    protected $model = CartPlane::class;

    public function definition(): array
    {
        return [
            'cart_id' => ShoppingCart::factory(),
            'plane_id' => Plane::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
