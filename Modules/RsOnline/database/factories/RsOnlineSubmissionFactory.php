<?php

namespace Modules\RsOnline\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\RsOnline\Models\RsOnlineSubmission;

class RsOnlineSubmissionFactory extends Factory
{
    protected $model = RsOnlineSubmission::class;

    public function definition(): array
    {
        return [
            'resource' => fake()->randomElement(['data_sdm', 'data_layanan', 'alkes_data', 'data_tempat_tidur', 'registrasi_user']),
            'payload' => ['keterangan' => fake()->sentence()],
            'status' => 'pending',
        ];
    }
}
