<?php

namespace Modules\MedicalRecordBackExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordBackExamination\Database\Factories\BackExaminationFactory;

class BackExamination extends Model
{
    use HasFactory;

    protected $table = 'back_examinations';

    protected $fillable = [
        'visit_id',
        'spine_alignment',
        'scoliosis',
        'kyphosis',
        'lordosis',
        'tenderness',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'scoliosis' => 'boolean',
        'kyphosis' => 'boolean',
        'lordosis' => 'boolean',
        'tenderness' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): BackExaminationFactory
    {
        return BackExaminationFactory::new();
    }
}
