<?php

namespace Modules\Sisrute\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sisrute\Models\Rujukan;

class RujukanFactory extends Factory
{
    protected $model = Rujukan::class;

    public function definition(): array
    {
        return [
            'direction' => fake()->randomElement(['outbound', 'inbound']),
            'action' => 'rujukan',
            'payload' => ['no_rm' => fake()->numerify('##########')],
            'status' => 'pending',
        ];
    }
}
