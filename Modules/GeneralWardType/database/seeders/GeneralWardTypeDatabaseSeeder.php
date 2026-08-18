<?php

namespace Modules\GeneralWardType\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralWardType\Models\WardType;

class GeneralWardTypeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Rawat Jalan', 'code' => 'RAJAL'],
            ['name' => 'Rawat Inap', 'code' => 'RANAP'],
            ['name' => 'Gawat Darurat', 'code' => 'IGD'],
            ['name' => 'Rawat Intensif', 'code' => 'ICU'],
            ['name' => 'Kamar Operasi', 'code' => 'OK'],
            ['name' => 'Penunjang', 'code' => 'PNJ'],
        ];

        foreach ($items as $item) {
            WardType::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
