<?php

namespace Modules\PendaftaranAccidentRecord\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranAccidentRecord\Models\AccidentRecord;
use Modules\PendaftaranVisit\Models\Visit;

class AccidentRecordFactory extends Factory
{
    protected $model = AccidentRecord::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'accident_type' => $this->faker->randomElement(['Traffic', 'Workplace', 'Home', 'Other']),
            'accident_at' => $this->faker->dateTimeThisMonth(),
            'location' => $this->faker->address(),
            'police_report_number' => $this->faker->optional()->numerify('POL-########'),
        ];
    }
}
