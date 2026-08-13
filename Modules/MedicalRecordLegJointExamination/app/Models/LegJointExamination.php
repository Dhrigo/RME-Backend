<?php

namespace Modules\MedicalRecordLegJointExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordLegJointExamination\Database\Factories\LegJointExaminationFactory;

class LegJointExamination extends Model
{
    use HasFactory;

    protected $table = 'leg_joint_examinations';

    protected $fillable = [
        'visit_id',
        'joint',
        'range_of_motion',
        'swelling',
        'tenderness',
        'deformity',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'swelling' => 'boolean',
        'tenderness' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): LegJointExaminationFactory
    {
        return LegJointExaminationFactory::new();
    }
}
