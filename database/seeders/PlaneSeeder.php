<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plane;

class PlaneSeeder extends Seeder
{
    public function run()
    {
        $planes = [
            ['plane_name' => 'Boeing 737', 'model' => '737-800', 'capacity' => 189, 'speed' => 850, 'status' => 'available'],
            ['plane_name' => 'Airbus A320', 'model' => 'A320-200', 'capacity' => 180, 'speed' => 830, 'status' => 'available'],
            ['plane_name' => 'Boeing 777', 'model' => '777-300ER', 'capacity' => 396, 'speed' => 905, 'status' => 'available'],
            ['plane_name' => 'Airbus A380', 'model' => 'A380-800', 'capacity' => 853, 'speed' => 945, 'status' => 'available'],
            ['plane_name' => 'Boeing 787', 'model' => '787-9 Dreamliner', 'capacity' => 296, 'speed' => 910, 'status' => 'available'],
            ['plane_name' => 'Concorde', 'model' => 'Concorde SST', 'capacity' => 92, 'speed' => 2179, 'status' => 'available'],
            ['plane_name' => 'Cessna 172', 'model' => 'Skyhawk', 'capacity' => 4, 'speed' => 226, 'status' => 'available'],
            ['plane_name' => 'Lockheed Martin', 'model' => 'C-130 Hercules', 'capacity' => 92, 'speed' => 540, 'status' => 'available'],
            ['plane_name' => 'Boeing 747', 'model' => '747-8I', 'capacity' => 410, 'speed' => 920, 'status' => 'available'],
            ['plane_name' => 'Embraer E195', 'model' => 'E195-E2', 'capacity' => 132, 'speed' => 870, 'status' => 'available'],
            ['plane_name' => 'Bombardier', 'model' => 'CRJ-900', 'capacity' => 90, 'speed' => 870, 'status' => 'available'],
            ['plane_name' => 'Airbus A330', 'model' => 'A330-900', 'capacity' => 287, 'speed' => 913, 'status' => 'available'],
            ['plane_name' => 'Boeing 767', 'model' => '767-300F', 'capacity' => 200, 'speed' => 850, 'status' => 'available'],
            ['plane_name' => 'Antonov', 'model' => 'An-225 Mriya', 'capacity' => 1500, 'speed' => 850, 'status' => 'available'],
            ['plane_name' => 'Dassault Falcon', 'model' => 'Falcon 8X', 'capacity' => 19, 'speed' => 900, 'status' => 'available'],
            ['plane_name' => 'Antonov', 'model' => 'An-225 Mriya', 'capacity' => 1500, 'speed' => 850, 'status' => 'available'],
        ];

        foreach ($planes as $plane) {
            Plane::create($plane);
        }
    }
}

