<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Worker;
use App\Models\User;

class WorkerSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('username', 'admin')->first();
        $adminWorker = Worker::create([
            'person_id' => $adminUser->id,
            'date_of_employment' => now(),
            'is_admin' => true,
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $user = User::where('username', 'worker' . $i)->first();
            $worker = Worker::create([
                'person_id' => $user->id,
                'date_of_employment' => now(),
                'is_admin' => false,
            ]);
        }
    }
}
