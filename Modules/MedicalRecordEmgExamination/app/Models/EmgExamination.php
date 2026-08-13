<?php

namespace Modules\MedicalRecordEmgExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordEmgExamination\Database\Factories\EmgExaminationFactory;

class EmgExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'emg_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'nerve_conduction_velocity',
        'spontaneous_activity',
        'motor_unit_potentials',
        'recruitment_pattern',
        'conclusion',
        'examined_at',
    ];

    protected $casts = [
        'nerve_conduction_velocity' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): EmgExaminationFactory
    {
        return EmgExaminationFactory::new();
    }
}
