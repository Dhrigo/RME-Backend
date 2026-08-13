<?php

namespace Modules\MedicalRecordChestExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordChestExamination\Database\Factories\ChestExaminationFactory;

class ChestExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chest_examinations';

    protected $fillable = [
        'visit_id',
        'inspection',
        'palpation',
        'percussion',
        'auscultation_breath_sounds',
        'auscultation_heart_sounds',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ChestExaminationFactory
    {
        return ChestExaminationFactory::new();
    }
}
