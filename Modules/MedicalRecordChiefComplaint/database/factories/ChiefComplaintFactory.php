<?php

namespace Modules\MedicalRecordChiefComplaint\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordChiefComplaint\Models\ChiefComplaint;

class ChiefComplaintFactory extends Factory
{
    protected $model = ChiefComplaint::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'complaint' => fake()->sentence(),
            'onset' => fake()->words(3, true),
            'duration' => fake()->words(3, true),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
