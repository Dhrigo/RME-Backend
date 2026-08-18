<?php

namespace Modules\GeneralEthnicity\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralEthnicity\Models\Ethnicity;

class GeneralEthnicityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Jawa', 'code' => 'JAWA'],
            ['name' => 'Sunda', 'code' => 'SUNDA'],
            ['name' => 'Batak', 'code' => 'BATAK'],
            ['name' => 'Minangkabau', 'code' => 'MINANG'],
            ['name' => 'Bugis', 'code' => 'BUGIS'],
            ['name' => 'Bali', 'code' => 'BALI'],
            ['name' => 'Betawi', 'code' => 'BETAWI'],
            ['name' => 'Madura', 'code' => 'MADURA'],
            ['name' => 'Banjar', 'code' => 'BANJAR'],
            ['name' => 'Aceh', 'code' => 'ACEH'],
            ['name' => 'Dayak', 'code' => 'DAYAK'],
            ['name' => 'Melayu', 'code' => 'MELAYU'],
            ['name' => 'Sasak', 'code' => 'SASAK'],
            ['name' => 'Toraja', 'code' => 'TORAJA'],
            ['name' => 'Papua', 'code' => 'PAPUA'],
        ];

        foreach ($items as $item) {
            Ethnicity::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
