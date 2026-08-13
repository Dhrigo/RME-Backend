<?php

namespace Modules\GeneralDiagnosisRestriction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralDiagnosisRestriction\Models\DiagnosisRestriction;

class DiagnosisRestrictionFactory extends Factory
{
    protected $model = DiagnosisRestriction::class;

    public function definition(): array
    {
        return [
            'diagnosis_code_id' => DiagnosisCode::factory(),
            'restricted_antibiotic_name' => fake()->randomElement(['Meropenem', 'Vancomycin', 'Colistin']),
            'requires_justification' => true,
            'notes' => 'Hanya boleh diresepkan untuk diagnosis infeksi berat yang terbukti resisten terhadap lini pertama.',
            'is_active' => true,
        ];
    }
}
