<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartPlane;
use App\Models\ShoppingCart;
use App\Models\Plane;

class CartPlaneSeeder extends Seeder
{
    public function run(): void
    {
        $planeIds = Plane::where('status', 'available')->pluck('id')->toArray();

        for ($i = 1; $i <= 3; $i++) {
            $cart = ShoppingCart::find($i);
            if ($cart) {
                $randomPlaneIds = collect($planeIds)->random(rand(1, count($planeIds)))->all();

                foreach ($randomPlaneIds as $planeId) {
                    CartPlane::create([
                        'cart_id' => $cart->id,
                        'plane_id' => $planeId,
                    ]);
                }
            }
        }
    }
}
