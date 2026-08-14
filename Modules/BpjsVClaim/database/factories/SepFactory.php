<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\Sep;
use Modules\GeneralPatient\Models\Patient;

class SepFactory extends Factory
{
    protected $model = Sep::class;

    public function definition(): array
    {
        return [
            'visit_type' => 'igd',
            'patient_id' => Patient::factory(),
            'no_kartu' => fake()->numerify('####################'),
            'tgl_sep' => now()->toDateString(),
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '0',
            'suplesi_jasa_raharja' => false,
            'local_status' => 'draft',
        ];
    }
}
