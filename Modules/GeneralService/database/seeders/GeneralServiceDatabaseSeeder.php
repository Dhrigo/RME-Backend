<?php

namespace Modules\GeneralService\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralService\Models\Service;

class GeneralServiceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['code' => 'KONS-UM', 'name' => 'Konsultasi Dokter Umum', 'category' => 'Konsultasi'],
            ['code' => 'KONS-SP', 'name' => 'Konsultasi Dokter Spesialis', 'category' => 'Konsultasi'],
            ['code' => 'RWT-LUKA', 'name' => 'Perawatan Luka', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'INJEKSI', 'name' => 'Injeksi/Suntik', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'INFUS', 'name' => 'Pemasangan Infus', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'KATETER', 'name' => 'Pemasangan Kateter', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'NGT', 'name' => 'Pemasangan NGT', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'NEBUL', 'name' => 'Nebulizer', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'GDS', 'name' => 'Pemeriksaan Gula Darah Sewaktu', 'category' => 'Laboratorium'],
            ['code' => 'LAB-DL', 'name' => 'Pemeriksaan Darah Lengkap', 'category' => 'Laboratorium'],
            ['code' => 'LAB-UR', 'name' => 'Pemeriksaan Urine Lengkap', 'category' => 'Laboratorium'],
            ['code' => 'RO-THX', 'name' => 'Rontgen Thorax', 'category' => 'Radiologi'],
            ['code' => 'USG', 'name' => 'USG', 'category' => 'Radiologi'],
            ['code' => 'EKG', 'name' => 'Rekam Jantung (EKG)', 'category' => 'Penunjang'],
            ['code' => 'JAHIT', 'name' => 'Hecting/Jahit Luka', 'category' => 'Tindakan Medis'],
            ['code' => 'GANTI-VERBAN', 'name' => 'Ganti Verban', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'FISIO', 'name' => 'Fisioterapi', 'category' => 'Rehabilitasi'],
            ['code' => 'VISITE', 'name' => 'Visite Dokter', 'category' => 'Konsultasi'],
            ['code' => 'OBS-TTV', 'name' => 'Observasi Tanda Vital', 'category' => 'Tindakan Keperawatan'],
            ['code' => 'TRANSFUSI', 'name' => 'Transfusi Darah', 'category' => 'Tindakan Medis'],
        ];

        foreach ($items as $item) {
            Service::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code'], 'category' => $item['category'], 'is_active' => true]
            );
        }
    }
}
