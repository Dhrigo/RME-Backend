<?php

namespace Modules\GeneralMedicalDepartment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;

class GeneralMedicalDepartmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medical_departments')->delete();

        $items = [
            ['name' => 'Non Spesialis/Subspesialis', 'code' => null],
            ['name' => 'Interna', 'code' => null],
            ['name' => 'Jiwa', 'code' => null],
            ['name' => 'Mata', 'code' => null],
            ['name' => 'Obgyn', 'code' => null],
            ['name' => 'Gigi', 'code' => null],
            ['name' => 'Anastesi', 'code' => null],
            ['name' => 'THT-KL', 'code' => null],
            ['name' => 'Bedah Orthopedi', 'code' => null],
            ['name' => 'Reumatologi', 'code' => null],
            ['name' => 'Bedah Saraf', 'code' => null],
            ['name' => 'Anak', 'code' => null],
            ['name' => 'Kulit & Kelamin', 'code' => null],
            ['name' => 'Bedah Umum', 'code' => null],
            ['name' => 'THT', 'code' => null],
            ['name' => 'Saraf', 'code' => null],
            ['name' => 'Kardiologi', 'code' => null],
            ['name' => 'Endokrin', 'code' => null],
            ['name' => 'Bedah Plastik', 'code' => null],
            ['name' => 'Bedah Urologi', 'code' => null],
            ['name' => 'Bedah Digestif', 'code' => null],
            ['name' => 'Bedah Thorax dan Vasculer', 'code' => null],
            ['name' => 'Bedah Jantung', 'code' => null],
            ['name' => 'Bedah Anak', 'code' => null],
            ['name' => 'Bedah Tumor', 'code' => null],
            ['name' => 'Patologi Klinik', 'code' => null],
            ['name' => 'Gizi', 'code' => null],
            ['name' => 'Radiologi', 'code' => null],
            ['name' => 'Laboratorium', 'code' => null],
            ['name' => 'Rehab Medik', 'code' => null],
            ['name' => 'Patologi Anatomi', 'code' => null],
            ['name' => 'Dokter Umum', 'code' => null],
            ['name' => 'Forensik dan Medikolegal', 'code' => null],
            ['name' => 'Paru', 'code' => null],
            ['name' => 'Radioterapi', 'code' => null],
            ['name' => 'Infeksi Tropis', 'code' => null],
        ];

        foreach ($items as $item) {
            MedicalDepartment::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}

