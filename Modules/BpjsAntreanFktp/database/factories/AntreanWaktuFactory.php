<?php

namespace Modules\BpjsAntreanFktp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsAntreanFktp\Models\Antrean;
use Modules\BpjsAntreanFktp\Models\AntreanWaktu;

class AntreanWaktuFactory extends Factory
{
    protected $model = AntreanWaktu::class;

    public function definition(): array
    {
        return [
            'antrean_id' => Antrean::factory(),
            'task_id' => 1,
            'waktu' => now(),
            'jenis_resep' => null,
            'bpjs_sync_status' => 'pending',
            'bpjs_error' => null,
        ];
    }
}
