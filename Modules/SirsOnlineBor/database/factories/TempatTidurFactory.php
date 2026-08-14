<?php

namespace Modules\SirsOnlineBor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SirsOnlineBor\Models\TempatTidur;

class TempatTidurFactory extends Factory
{
    protected $model = TempatTidur::class;

    public function definition(): array
    {
        return [
            'id_tt' => fake()->unique()->numerify('TT-####'),
            'ruang' => fake()->word(),
            'jumlah_ruang' => fake()->numberBetween(1, 20),
            'jumlah' => fake()->numberBetween(1, 20),
            'terpakai' => fake()->numberBetween(0, 10),
            'terpakai_suspek' => 0,
            'terpakai_konfirmasi' => 0,
            'antrian' => 0,
            'prepare' => 0,
            'prepare_plan' => 0,
            'covid' => 0,
            'terpakai_dbd' => 0,
            'terpakai_dbd_anak' => 0,
            'jumlah_dbd' => 0,
            'status' => 'pending',
        ];
    }
}
