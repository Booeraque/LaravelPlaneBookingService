<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            $user = User::where('username', 'customer' . $i)->first();
            $customer = Customer::create([
                'person_id' => $user->id,
                'account_creation_date' => now(),
            ]);
        }
    }
}
