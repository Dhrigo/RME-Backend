<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordSkinPrickTestExamination\Models\SkinPrickTestExamination;

class SkinPrickTestExaminationFactory extends Factory
{
    protected $model = SkinPrickTestExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'allergen' => 'House dust mite',
            'wheal_size_mm' => 3.0,
            'flare_size_mm' => 5.0,
            'result' => 'positive',
            'reaction_onset_minutes' => 15,
            'notes' => null,
            'tested_at' => now(),
        ];
    }
}
