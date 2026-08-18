<?php

namespace Modules\GeneralProfession\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\GeneralProfession\Models\Profession;

class GeneralProfessionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->delete();

        $items = [
            ['name' => 'Administrasi', 'code' => null],
            ['name' => 'Analis', 'code' => null],
            ['name' => 'Bidan', 'code' => null],
            ['name' => 'Dokter', 'code' => null],
            ['name' => 'Farmasi', 'code' => null],
            ['name' => 'Perawat', 'code' => null],
            ['name' => 'Perekam Medis', 'code' => null],
            ['name' => 'Radiografer', 'code' => null],
            ['name' => 'Fisioterapis', 'code' => null],
            ['name' => 'Penata Anastesi', 'code' => null],
        ];

        foreach ($items as $item) {
            Profession::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'is_active' => true]
            );
        }
    }
}

