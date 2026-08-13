<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRehabilitationProcedureExamination\Models\RehabilitationProcedureExamination;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Models\RehabilitationProcedureExaminationItem;

class RehabilitationProcedureExaminationItemFactory extends Factory
{
    protected $model = RehabilitationProcedureExaminationItem::class;

    public function definition(): array
    {
        return [
            'rehabilitation_procedure_examination_id' => RehabilitationProcedureExamination::factory(),
            'step_name' => 'Shoulder flexion exercise',
            'duration_minutes' => 10,
            'result' => 'Tolerated well',
            'sequence' => 1,
        ];
    }
}
