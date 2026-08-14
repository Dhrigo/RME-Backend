<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Kunjungan;
use Modules\BpjsPCare\Models\Prognosa;

class PrognosaFactory extends Factory
{
    protected $model = Prognosa::class;

    public function definition(): array
    {
        return [
            'kunjungan_id' => Kunjungan::factory(),
            'kode_diagnosa' => $this->faker->bothify('?##'),
            'nama_diagnosa' => $this->faker->sentence(3),
            'hasil_prognosa' => $this->faker->randomElement(['sembuh', 'membaik', 'tetap', 'memburuk', 'meninggal']),
            'catatan' => $this->faker->sentence(),
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
