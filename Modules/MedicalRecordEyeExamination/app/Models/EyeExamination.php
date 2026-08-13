<?php

namespace Modules\MedicalRecordEyeExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordEyeExamination\Database\Factories\EyeExaminationFactory;

class EyeExamination extends Model
{
    use HasFactory;

    protected $table = 'eye_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'visual_acuity',
        'pupil_size_mm',
        'pupil_reflex',
        'conjunctiva',
        'sclera',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): EyeExaminationFactory
    {
        return EyeExaminationFactory::new();
    }
}
