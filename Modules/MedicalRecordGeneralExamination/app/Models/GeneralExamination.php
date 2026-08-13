<?php

namespace Modules\MedicalRecordGeneralExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordGeneralExamination\Database\Factories\GeneralExaminationFactory;

class GeneralExamination extends Model
{
    use HasFactory;

    protected $table = 'general_examinations';

    protected $fillable = [
        'visit_id',
        'general_appearance',
        'consciousness_level',
        'nutritional_status',
        'posture',
        'gait',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): GeneralExaminationFactory
    {
        return GeneralExaminationFactory::new();
    }
}
