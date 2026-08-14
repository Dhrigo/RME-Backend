<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Kunjungan;
use Modules\BpjsPCare\Models\Mcu;

class McuFactory extends Factory
{
    protected $model = Mcu::class;

    public function definition(): array
    {
        return [
            'kunjungan_id' => Kunjungan::factory(),
            'tanggal_mcu' => $this->faker->date(),
            'tinggi_badan' => $this->faker->randomFloat(2, 140, 190),
            'berat_badan' => $this->faker->randomFloat(2, 40, 100),
            'lingkar_perut' => $this->faker->randomFloat(2, 60, 110),
            'tensi_sistole' => $this->faker->numberBetween(90, 160),
            'tensi_diastole' => $this->faker->numberBetween(60, 100),
            'gula_darah' => $this->faker->randomFloat(2, 70, 200),
            'kolesterol' => $this->faker->randomFloat(2, 120, 260),
            'asam_urat' => $this->faker->randomFloat(2, 2, 8),
            'hasil_mcu' => $this->faker->sentence(),
            'rekomendasi' => $this->faker->sentence(),
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
