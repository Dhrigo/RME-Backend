<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Alergi;
use Modules\BpjsPCare\Models\Kunjungan;

class AlergiFactory extends Factory
{
    protected $model = Alergi::class;

    public function definition(): array
    {
        return [
            'kunjungan_id' => Kunjungan::factory(),
            'jenis_alergi' => $this->faker->randomElement(['obat', 'makanan', 'lainnya']),
            'nama_alergi' => $this->faker->word(),
            'reaksi' => $this->faker->sentence(),
            'tingkat_keparahan' => $this->faker->randomElement(['ringan', 'sedang', 'berat']),
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
