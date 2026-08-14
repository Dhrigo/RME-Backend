<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\Sep;
use Modules\BpjsVClaim\Models\SepPengajuan;

class SepPengajuanFactory extends Factory
{
    protected $model = SepPengajuan::class;

    public function definition(): array
    {
        return [
            'sep_id' => Sep::factory(),
            'jenis' => 'fingerprint',
            'alasan' => fake()->sentence(6),
            'status' => 'submitted',
        ];
    }
}
