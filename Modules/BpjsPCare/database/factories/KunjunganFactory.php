<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Kunjungan;

class KunjunganFactory extends Factory
{
    protected $model = Kunjungan::class;

    public function definition(): array
    {
        return [
            'pendaftaran_id' => null,
            'nomor_kunjungan' => null,
            'no_kartu' => $this->faker->numerify('#################'),
            'tanggal_kunjungan' => $this->faker->date(),
            'jenis_kunjungan' => $this->faker->randomElement(['baru', 'lama']),
            'kode_poli' => $this->faker->numerify('##'),
            'kode_dokter' => $this->faker->numerify('###'),
            'no_rujukan' => null,
            'keluhan' => $this->faker->sentence(),
            'tensi_sistole' => $this->faker->numberBetween(90, 160),
            'tensi_diastole' => $this->faker->numberBetween(60, 100),
            'nadi' => $this->faker->numberBetween(60, 100),
            'suhu' => $this->faker->randomFloat(1, 36, 39),
            'pernafasan' => $this->faker->numberBetween(16, 24),
            'tinggi_badan' => $this->faker->randomFloat(2, 140, 190),
            'berat_badan' => $this->faker->randomFloat(2, 40, 100),
            'kode_status_pulang' => null,
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
