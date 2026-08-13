<?php

namespace Modules\MedicalRecordAbdomenExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordAbdomenExamination\Database\Factories\AbdomenExaminationFactory;

class AbdomenExamination extends Model
{
    use HasFactory;

    protected $table = 'abdomen_examinations';

    protected $fillable = [
        'visit_id',
        'inspection',
        'auscultation_bowel_sounds',
        'palpation',
        'percussion',
        'tenderness',
        'distension',
        'liver_span_cm',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'tenderness' => 'boolean',
        'distension' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): AbdomenExaminationFactory
    {
        return AbdomenExaminationFactory::new();
    }
}
