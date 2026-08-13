<?php

namespace Modules\LayananRadiologyViewerLog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananRadiologyViewerLog\Models\RadiologyViewerLog;

class RadiologyViewerLogFactory extends Factory
{
    protected $model = RadiologyViewerLog::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'accession_number' => fake()->words(3, true),
            'viewed_by' => Employee::factory(),
            'viewed_at' => now(),
            'ip_address' => fake()->words(3, true),
            'notes' => fake()->sentence(),
        ];
    }
}
