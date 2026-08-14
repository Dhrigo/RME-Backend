<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\RujukanAntarRs;
use Modules\GeneralPatient\Models\Patient;

class RujukanAntarRsFactory extends Factory
{
    protected $model = RujukanAntarRs::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'no_sep_asal' => fake()->numerify('#####################'),
            'tanggal_rencana_kunjungan' => now()->addDays(2)->toDateString(),
            'jenis_pelayanan' => '2',
            'tipe_rujukan' => '0',
            'ppk_tujuan' => fake()->numerify('#######'),
            'diagnosa' => 'A00.0',
            'local_status' => 'draft',
        ];
    }
}
