<?php

namespace Modules\MedicalRecordRavenTestExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordRavenTestExamination\Database\Factories\RavenTestExaminationFactory;

class RavenTestExamination extends Model
{
    use HasFactory;

    protected $table = 'raven_test_examinations';

    protected $fillable = [
        'visit_id',
        'test_form',
        'raw_score',
        'percentile',
        'iq_grade',
        'examiner_notes',
        'tested_at',
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    protected static function newFactory(): RavenTestExaminationFactory
    {
        return RavenTestExaminationFactory::new();
    }
}
