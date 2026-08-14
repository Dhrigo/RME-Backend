<?php

namespace Modules\BpjsRekamMedis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsRekamMedis\Models\Klaim;

class KlaimFactory extends Factory
{
    protected $model = Klaim::class;

    public function definition(): array
    {
        return [
            'no_sep' => strtoupper(fake()->bothify('##########??##########')),
            'jenis_pelayanan_id' => '2',
            'bulan' => now()->format('m'),
            'tahun' => now()->format('Y'),
            'dibuat_oleh' => 'system',
            'dibuat_tanggal' => now(),
            'status' => 'draft',
        ];
    }
}
