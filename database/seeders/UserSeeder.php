<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@example.com',
            'name' => 'Admin User',
        ]);

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'username' => 'worker' . $i,
                'password' => Hash::make('password'),
                'email' => 'worker' . $i . '@example.com',
                'name' => 'Worker ' . $i,
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            User::create([
                'username' => 'customer' . $i,
                'password' => Hash::make('password'),
                'email' => 'customer' . $i . '@example.com',
                'name' => 'Customer ' . $i,
            ]);
        }
    }
}
