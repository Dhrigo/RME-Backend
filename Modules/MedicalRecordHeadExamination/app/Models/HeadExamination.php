<?php

namespace Modules\MedicalRecordHeadExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordHeadExamination\Database\Factories\HeadExaminationFactory;

class HeadExamination extends Model
{
    use HasFactory;

    protected $table = 'head_examinations';

    protected $fillable = [
        'visit_id',
        'skull_shape',
        'hair_distribution',
        'facial_symmetry',
        'tenderness',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'tenderness' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): HeadExaminationFactory
    {
        return HeadExaminationFactory::new();
    }
}
