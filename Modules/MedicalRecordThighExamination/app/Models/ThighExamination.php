<?php

namespace Modules\MedicalRecordThighExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordThighExamination\Database\Factories\ThighExaminationFactory;

class ThighExamination extends Model
{
    use HasFactory;

    protected $table = 'thigh_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'muscle_strength',
        'circumference_cm',
        'swelling',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'swelling' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ThighExaminationFactory
    {
        return ThighExaminationFactory::new();
    }
}
