<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAnesthesiaPreparation\Models\AnesthesiaPreparation;

class AnesthesiaPreparationFactory extends Factory
{
    protected $model = AnesthesiaPreparation::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'prepared_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'fasting_hours' => fake()->numberBetween(6,12),
            'allergy_checked' => true,
            'mallampati_score' => fake()->numberBetween(1,4),
            'consent_confirmed' => true,
            'equipment_checklist' => fake()->sentence(6),
            'prepared_at' => now(),
        ];
    }
}
