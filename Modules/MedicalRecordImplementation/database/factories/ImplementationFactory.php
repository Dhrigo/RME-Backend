<?php

namespace Modules\MedicalRecordImplementation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImplementation\Models\Implementation;

class ImplementationFactory extends Factory
{
    protected $model = Implementation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'order_reference' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'performed_by' => Employee::factory(),
            'performed_at' => now(),
            'status' => 'completed',
        ];
    }
}
