<?php

namespace Modules\KemkesBloodType\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KemkesBloodType\Models\BloodType;

class KemkesBloodTypeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'A', 'code' => 'A'],
            ['name' => 'B', 'code' => 'B'],
            ['name' => 'AB', 'code' => 'AB'],
            ['name' => 'O', 'code' => 'O'],
            ['name' => 'A+', 'code' => 'A_POS'],
            ['name' => 'A-', 'code' => 'A_NEG'],
            ['name' => 'B+', 'code' => 'B_POS'],
            ['name' => 'B-', 'code' => 'B_NEG'],
            ['name' => 'AB+', 'code' => 'AB_POS'],
            ['name' => 'AB-', 'code' => 'AB_NEG'],
            ['name' => 'O+', 'code' => 'O_POS'],
            ['name' => 'O-', 'code' => 'O_NEG'],
            ['name' => 'Tidak Tahu', 'code' => 'UNKNOWN'],
        ];

        foreach ($items as $item) {
            BloodType::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
