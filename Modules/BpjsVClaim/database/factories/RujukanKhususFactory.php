<?php

namespace Modules\BpjsVClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsVClaim\Models\RujukanKhusus;

class RujukanKhususFactory extends Factory
{
    protected $model = RujukanKhusus::class;

    public function definition(): array
    {
        return [
            'no_rujukan_asal' => fake()->numerify('#####################'),
            'diagnosa' => 'N18.0',
            'kode_prosedur' => fake()->numerify('##.##'),
            'local_status' => 'draft',
        ];
    }
}
