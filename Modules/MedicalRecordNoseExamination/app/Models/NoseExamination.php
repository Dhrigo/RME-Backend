<?php

namespace Modules\MedicalRecordNoseExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordNoseExamination\Database\Factories\NoseExaminationFactory;

class NoseExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nose_examinations';

    protected $fillable = [
        'visit_id',
        'deformity',
        'septum_deviation',
        'turbinate_hypertrophy',
        'nasal_discharge',
        'polyp_present',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'septum_deviation' => 'boolean',
        'turbinate_hypertrophy' => 'boolean',
        'polyp_present' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): NoseExaminationFactory
    {
        return NoseExaminationFactory::new();
    }
}
