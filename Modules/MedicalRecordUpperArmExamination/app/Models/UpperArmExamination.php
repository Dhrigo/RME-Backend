<?php

namespace Modules\MedicalRecordUpperArmExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordUpperArmExamination\Database\Factories\UpperArmExaminationFactory;

class UpperArmExamination extends Model
{
    use HasFactory;

    protected $table = 'upper_arm_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'muscle_strength',
        'range_of_motion',
        'deformity',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'deformity' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): UpperArmExaminationFactory
    {
        return UpperArmExaminationFactory::new();
    }
}
