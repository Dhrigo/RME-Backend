<?php

namespace Modules\PendaftaranConsultationAnswer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranConsultationAnswer\Models\ConsultationAnswer;

class ConsultationAnswerFactory extends Factory
{
    protected $model = ConsultationAnswer::class;

    public function definition(): array
    {
        return [
            'consultation_id' => Consultation::factory(),
            'answered_by' => Employee::factory(),
            'answered_at' => $this->faker->dateTimeThisMonth(),
            'answer' => $this->faker->sentence(),
        ];
    }
}
