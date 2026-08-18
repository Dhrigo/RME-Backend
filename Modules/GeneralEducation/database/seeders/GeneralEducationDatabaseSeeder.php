<?php

namespace Modules\GeneralEducation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\GeneralEducation\Models\Education;

class GeneralEducationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educations')->delete();

        $items = [
            'Tidak/Belum Sekolah',
            'Belum Tamat SD/Sederajat',
            'Tamat SD/Sederajat',
            'SLTP/Sederajat',
            'SLTA/Sederajat',
            'Diploma I/II',
            'Akademi/Diploma III/Sarjana Muda',
            'Diploma IV/Strata I',
            'Strata II',
            'Strata III',
        ];

        foreach ($items as $name) {
            Education::firstOrCreate(
                ['name' => $name],
                ['is_active' => true]
            );
        }
    }
}

