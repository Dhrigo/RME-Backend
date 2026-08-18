<?php

namespace Modules\GeneralMaritalStatus\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralMaritalStatus\Models\MaritalStatus;

class GeneralMaritalStatusDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Belum Kawin', 'code' => 'SINGLE'],
            ['name' => 'Kawin', 'code' => 'MARRIED'],
            ['name' => 'Cerai Hidup', 'code' => 'DIVORCED'],
            ['name' => 'Cerai Mati', 'code' => 'WIDOWED'],
        ];

        foreach ($items as $item) {
            MaritalStatus::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}
