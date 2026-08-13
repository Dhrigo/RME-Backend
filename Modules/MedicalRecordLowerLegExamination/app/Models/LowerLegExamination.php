<?php

namespace Modules\MedicalRecordLowerLegExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordLowerLegExamination\Database\Factories\LowerLegExaminationFactory;

class LowerLegExamination extends Model
{
    use HasFactory;

    protected $table = 'lower_leg_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'muscle_strength',
        'edema',
        'pulses',
        'skin_condition',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'edema' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): LowerLegExaminationFactory
    {
        return LowerLegExaminationFactory::new();
    }
}
