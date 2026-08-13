<?php

namespace Modules\MedicalRecordHandJointExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordHandJointExamination\Database\Factories\HandJointExaminationFactory;

class HandJointExamination extends Model
{
    use HasFactory;

    protected $table = 'hand_joint_examinations';

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

    protected static function newFactory(): HandJointExaminationFactory
    {
        return HandJointExaminationFactory::new();
    }
}
