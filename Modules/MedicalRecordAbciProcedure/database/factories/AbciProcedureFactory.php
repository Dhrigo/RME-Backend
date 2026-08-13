<?php

namespace Modules\MedicalRecordAbciProcedure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAbciProcedure\Models\AbciProcedure;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class AbciProcedureFactory extends Factory
{
    protected $model = AbciProcedure::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'procedure_date' => now(),
            'indication' => 'ABCI protocol evaluation',
            'procedure_details' => 'Performed ABCI clinical intervention procedure',
            'outcome' => 'Successful intervention without acute complications',
            'notes' => $this->faker->sentence(),
        ];
    }
}
