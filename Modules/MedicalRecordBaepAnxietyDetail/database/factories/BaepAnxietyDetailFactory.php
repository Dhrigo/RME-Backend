<?php

namespace Modules\MedicalRecordBaepAnxietyDetail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBaepAnxietyDetail\Models\BaepAnxietyDetail;

class BaepAnxietyDetailFactory extends Factory
{
    protected $model = BaepAnxietyDetail::class;

    public function definition(): array
    {
        return [
            'baep_protocol_id' => \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory(),
            'scale_used' => 'HAM-A',
            'score' => fake()->numberBetween(0,56),
            'severity_level' => fake()->randomElement(['mild','moderate','severe']),
        ];
    }
}
