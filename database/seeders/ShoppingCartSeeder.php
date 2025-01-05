<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingCart;
use App\Models\Customer;

class ShoppingCartSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            $cart = ShoppingCart::create([
                'customer_id' => $customer->id,
            ]);

            $customer->update(['shopping_cart_id' => $cart->id]);
        }
    }
}
