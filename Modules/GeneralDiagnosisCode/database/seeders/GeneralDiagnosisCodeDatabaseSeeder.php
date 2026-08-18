<?php

namespace Modules\GeneralDiagnosisCode\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;

class GeneralDiagnosisCodeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['code' => 'A09', 'name' => 'Diare dan gastroenteritis'],
            ['code' => 'A90', 'name' => 'Demam Berdarah Dengue'],
            ['code' => 'B34.9', 'name' => 'Infeksi virus, tidak spesifik'],
            ['code' => 'E11', 'name' => 'Diabetes Melitus Tipe 2'],
            ['code' => 'E78.5', 'name' => 'Hiperlipidemia'],
            ['code' => 'I10', 'name' => 'Hipertensi Esensial'],
            ['code' => 'I50', 'name' => 'Gagal Jantung'],
            ['code' => 'J00', 'name' => 'Nasofaringitis Akut (Common Cold)'],
            ['code' => 'J02.9', 'name' => 'Faringitis Akut'],
            ['code' => 'J18.9', 'name' => 'Pneumonia'],
            ['code' => 'J45', 'name' => 'Asma'],
            ['code' => 'K29.7', 'name' => 'Gastritis'],
            ['code' => 'K30', 'name' => 'Dispepsia'],
            ['code' => 'K52.9', 'name' => 'Gastroenteritis dan Kolitis Non-infeksi'],
            ['code' => 'M54.5', 'name' => 'Nyeri Punggung Bawah (Low Back Pain)'],
            ['code' => 'N39.0', 'name' => 'Infeksi Saluran Kemih'],
            ['code' => 'R50.9', 'name' => 'Demam, tidak spesifik'],
            ['code' => 'R51', 'name' => 'Sakit Kepala'],
            ['code' => 'S06.0', 'name' => 'Cedera Kepala Ringan (Gegar Otak)'],
            ['code' => 'T14.9', 'name' => 'Cedera, tidak spesifik'],
        ];

        foreach ($items as $item) {
            DiagnosisCode::firstOrCreate(
                ['code' => $item['code']],
                ['name' => $item['name'], 'is_active' => true]
            );
        }
    }
}
