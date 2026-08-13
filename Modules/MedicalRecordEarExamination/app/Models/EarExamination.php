<?php

namespace Modules\MedicalRecordEarExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordEarExamination\Database\Factories\EarExaminationFactory;

class EarExamination extends Model
{
    use HasFactory;

    protected $table = 'ear_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'otoscopy',
        'tympanic_membrane',
        'hearing_test_result',
        'discharge',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'discharge' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): EarExaminationFactory
    {
        return EarExaminationFactory::new();
    }
}
