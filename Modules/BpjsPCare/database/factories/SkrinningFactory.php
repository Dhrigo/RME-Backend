<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Kunjungan;
use Modules\BpjsPCare\Models\Skrinning;

class SkrinningFactory extends Factory
{
    protected $model = Skrinning::class;

    public function definition(): array
    {
        return [
            'kunjungan_id' => Kunjungan::factory(),
            'jenis_skrinning' => $this->faker->randomElement(['riwayat_penyakit_dahulu', 'riwayat_penyakit_keluarga', 'gaya_hidup']),
            'pertanyaan' => $this->faker->sentence(),
            'jawaban' => $this->faker->sentence(),
            'skor' => $this->faker->numberBetween(0, 10),
            'kesimpulan' => $this->faker->sentence(),
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
