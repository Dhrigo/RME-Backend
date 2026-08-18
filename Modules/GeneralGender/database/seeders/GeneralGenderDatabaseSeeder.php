<?php

namespace Modules\GeneralGender\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralGender\Models\Gender;

class GeneralGenderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Laki-laki', 'code' => 'L'],
            ['name' => 'Perempuan', 'code' => 'P'],
        ];

        foreach ($items as $item) {
            Gender::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
