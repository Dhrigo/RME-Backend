<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordRehabilitationProcedureExamination\Database\Factories\RehabilitationProcedureExaminationFactory;

class RehabilitationProcedureExamination extends Model
{
    use HasFactory;

    protected $table = 'rehabilitation_procedure_examinations';

    protected $fillable = [
        'visit_id',
        'procedure_name',
        'therapist_id',
        'diagnosis_summary',
        'functional_goal',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): RehabilitationProcedureExaminationFactory
    {
        return RehabilitationProcedureExaminationFactory::new();
    }
}
