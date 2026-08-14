<?php

namespace Modules\BpjsApotek\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsApotek\Models\ApotekPelayananObat;
use Modules\BpjsApotek\Models\ApotekResep;

class ApotekPelayananObatFactory extends Factory
{
    protected $model = ApotekPelayananObat::class;

    public function definition(): array
    {
        return [
            'resep_id' => ApotekResep::factory(),
            'no_sep' => fake()->numerify('##################'),
            'tanggal_pelayanan' => now()->toDateString(),
            'bpjs_no_pelayanan' => null,
            'status' => 'draft',
            'bpjs_message' => null,
            'is_locked' => false,
            'submitted_at' => null,
            'deleted_at_bpjs' => null,
        ];
    }
}
