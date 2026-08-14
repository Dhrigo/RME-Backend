<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\Sep;
use Modules\BpjsVClaim\Models\Spri;

class SpriFactory extends Factory
{
    protected $model = Spri::class;

    public function definition(): array
    {
        return [
            'sep_id' => Sep::factory(),
            'tanggal_rencana_rawat_inap' => now()->addDays(3)->toDateString(),
            'local_status' => 'draft',
        ];
    }
}
