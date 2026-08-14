<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\RencanaKontrol;
use Modules\BpjsVClaim\Models\Sep;

class RencanaKontrolFactory extends Factory
{
    protected $model = RencanaKontrol::class;

    public function definition(): array
    {
        return [
            'sep_id' => Sep::factory(),
            'jenis_kontrol' => '1',
            'poli_kontrol' => 'INT',
            'tanggal_rencana_kontrol' => now()->addWeek()->toDateString(),
            'local_status' => 'draft',
        ];
    }
}
