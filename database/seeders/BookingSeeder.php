<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\ShoppingCart;
use App\Models\Worker;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 2; $i++) {
            $cart = ShoppingCart::find($i);
            $planes = $cart->planes;

            if ($planes->isNotEmpty()) {
                Booking::create([
                    'cart_id' => $cart->id,
                    'customer_id' => $cart->customer->id,
                    'worker_id' => Worker::find($i)->id,
                    'booking_date' => now(),
                    'additional_comments' => 'Booking ' . $i,
                ]);

                // Update the plane status to unavailable
                foreach ($planes as $plane) {
                    $plane->update(['status' => 'unavailable']);
                }

                // Create a new shopping cart for the customer
                $newCart = ShoppingCart::create([
                    'customer_id' => $cart->customer->id,
                ]);

                // Assign the new shopping cart to the customer
                $cart->customer->shopping_cart_id = $newCart->id;
                $cart->customer->save();
            }
        }
    }
}
