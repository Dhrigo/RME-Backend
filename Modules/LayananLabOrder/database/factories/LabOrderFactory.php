<?php

namespace Modules\LayananLabOrder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\PendaftaranVisit\Models\Visit;

class LabOrderFactory extends Factory
{
    protected $model = LabOrder::class;

    public function definition(): array
    {
        return [
            'order_number' => fake()->unique()->numerify('LAB-##########'),
            'visit_id' => Visit::factory(),
            'ordered_by' => Employee::factory(),
            'ordered_at' => now(),
            'destination' => 'Laboratorium Klinik',
            'is_emergency' => false,
            'reason' => null,
            'notes' => null,
            'status' => 'pending',
        ];
    }
}
