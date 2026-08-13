<?php

namespace Modules\PendaftaranConsultation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranVisit\Models\Visit;

class ConsultationFactory extends Factory
{
    protected $model = Consultation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'requesting_department_id' => MedicalDepartment::factory(),
            'consulted_department_id' => MedicalDepartment::factory(),
            'requested_at' => $this->faker->dateTimeThisMonth(),
            'question' => $this->faker->sentence(),
        ];
    }
}
