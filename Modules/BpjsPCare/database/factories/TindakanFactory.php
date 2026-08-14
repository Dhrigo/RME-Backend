<?php

namespace Modules\BpjsPCare\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsPCare\Models\Kunjungan;
use Modules\BpjsPCare\Models\Tindakan;

class TindakanFactory extends Factory
{
    protected $model = Tindakan::class;

    public function definition(): array
    {
        return [
            'kunjungan_id' => Kunjungan::factory(),
            'kode_tindakan' => $this->faker->bothify('##.##'),
            'nama_tindakan' => $this->faker->sentence(3),
            'tanggal_tindakan' => $this->faker->date(),
            'pelaksana' => $this->faker->name(),
            'catatan' => $this->faker->sentence(),
            'bpjs_response' => null,
            'bpjs_error' => null,
        ];
    }
}
