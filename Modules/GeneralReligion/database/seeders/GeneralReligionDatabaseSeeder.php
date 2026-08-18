<?php

namespace Modules\GeneralReligion\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\GeneralReligion\Models\Religion;

class GeneralReligionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->delete();

        $items = [
            'Islam',
            'Kristen (Protestan)',
            'Katholik',
            'Hindu',
            'Budha',
            'Konghuchu',
            'Kepercayaan Terhadap Tuhan YME / Penghayat',
            'Lain - lain',
        ];

        foreach ($items as $name) {
            Religion::firstOrCreate(
                ['name' => $name],
                ['is_active' => true]
            );
        }
    }
}

