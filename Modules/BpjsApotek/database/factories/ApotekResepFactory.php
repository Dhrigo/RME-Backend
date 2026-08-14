<?php

namespace Modules\BpjsApotek\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsApotek\Models\ApotekResep;
use Modules\PendaftaranVisit\Models\Visit;

class ApotekResepFactory extends Factory
{
    protected $model = ApotekResep::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'prescription_id' => null,
            'no_sep' => fake()->numerify('##################'),
            'no_kartu' => fake()->numerify('0001##########'),
            'tanggal_resep' => now()->toDateString(),
            'tanggal_input' => now()->toDateString(),
            'poli_kode' => 'INT',
            'request_payload' => null,
            'bpjs_no_resep' => null,
            'status' => 'draft',
            'bpjs_message' => null,
            'submitted_at' => null,
            'created_by' => null,
        ];
    }
}
