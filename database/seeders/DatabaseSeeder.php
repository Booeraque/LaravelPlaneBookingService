<?php

namespace Database\Seeders;

use App\Models\Plane;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            WorkerSeeder::class,
            PlaneSeeder::class,
            ShoppingCartSeeder::class,
            CartPlaneSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
