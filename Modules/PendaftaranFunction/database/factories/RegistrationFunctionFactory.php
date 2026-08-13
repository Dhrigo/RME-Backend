<?php

namespace Modules\PendaftaranFunction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranFunction\Models\RegistrationFunction;

class RegistrationFunctionFactory extends Factory
{
    protected $model = RegistrationFunction::class;

    public function definition(): array
    {
        return [
            'code' => 'FUNC-'.fake()->unique()->numerify('###'),
            'name' => fake()->randomElement(['Loket Pendaftaran', 'Verifikasi Jaminan', 'Admisi Rawat Inap', 'Informasi Pasien']),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
