<?php

namespace Modules\GeneralWardVisitType\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralWardVisitType\Models\WardVisitType;

class GeneralWardVisitTypeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Poliklinik', 'code' => 'POLI'],
            ['name' => 'IGD', 'code' => 'IGD'],
            ['name' => 'Rawat Inap', 'code' => 'RI'],
            ['name' => 'One Day Care', 'code' => 'ODC'],
            ['name' => 'Konsultasi', 'code' => 'KNS'],
        ];

        foreach ($items as $item) {
            WardVisitType::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
