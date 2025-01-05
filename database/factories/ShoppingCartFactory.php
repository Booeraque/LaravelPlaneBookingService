<?php

namespace Database\Factories;

use App\Models\ShoppingCart;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingCartFactory extends Factory
{
    protected $model = ShoppingCart::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
        ];
    }
}
