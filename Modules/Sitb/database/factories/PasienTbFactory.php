<?php

namespace Modules\Sitb\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sitb\Models\PasienTb;

class PasienTbFactory extends Factory
{
    protected $model = PasienTb::class;

    public function definition(): array
    {
        return [
            'nourut_pasien' => fake()->numerify('##########'),
            'nik' => fake()->numerify('################'),
            'jenis_kelamin' => fake()->randomElement([1, 2]),
            'alamat_lengkap' => fake()->address(),
            'tgl_lahir' => fake()->date(),
            'tahun' => (string) fake()->year(),
            'kirim' => 1,
        ];
    }
}
