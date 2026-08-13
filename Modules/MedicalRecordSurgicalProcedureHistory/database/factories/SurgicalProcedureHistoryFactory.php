<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordSurgicalProcedureHistory\Models\SurgicalProcedureHistory;

class SurgicalProcedureHistoryFactory extends Factory
{
    protected $model = SurgicalProcedureHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'created_by' => null,
            'procedure_name' => fake()->words(3,true),
            'procedure_date' => null,
            'facility_name' => fake()->company(),
            'surgeon_name' => fake()->name(),
            'complications' => null,
        ];
    }
}
