<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Pendaftaran;

class PendaftaranFactory extends Factory
{
    protected $model = Pendaftaran::class;

    public function definition(): array
    {
        return [
            'nomor_urut' => $this->faker->numberBetween(1, 200),
            'tanggal_daftar' => $this->faker->date(),
            'no_kartu' => $this->faker->numerify('#################'),
            'nik' => $this->faker->numerify('################'),
            'nama_pasien' => $this->faker->name(),
            'poli_tujuan' => $this->faker->numerify('##'),
            'no_hp' => $this->faker->numerify('08##########'),
            'keluhan' => $this->faker->sentence(),
            'status' => 'menunggu',
            'bpjs_no_pendaftaran' => null,
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
