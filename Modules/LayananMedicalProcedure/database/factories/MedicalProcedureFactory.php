<?php

namespace Modules\LayananMedicalProcedure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralService\Models\Service;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\PendaftaranVisit\Models\Visit;

class MedicalProcedureFactory extends Factory
{
    protected $model = MedicalProcedure::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'service_id' => Service::factory(),
            'performed_at' => now(),
            'performed_by' => Employee::factory(),
            'notes' => null,
            'status' => 'completed',
            'created_by' => null,
        ];
    }
}
