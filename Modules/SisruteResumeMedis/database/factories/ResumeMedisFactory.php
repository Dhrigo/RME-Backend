<?php

namespace Modules\SisruteResumeMedis\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SisruteResumeMedis\Models\ResumeMedis;

class ResumeMedisFactory extends Factory
{
    protected $model = ResumeMedis::class;

    public function definition(): array
    {
        return [
            'payload' => ['no_rm' => fake()->numerify('##########')],
            'status' => 'pending',
        ];
    }
}
