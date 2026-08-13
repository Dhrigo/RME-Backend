<?php

namespace Modules\MedicalRecordAnalExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordAnalExamination\Database\Factories\AnalExaminationFactory;

class AnalExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anal_examinations';

    protected $fillable = [
        'visit_id',
        'inspection',
        'palpation',
        'sphincter_tone',
        'rectal_toucher_findings',
        'ampulla_recti',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): AnalExaminationFactory
    {
        return AnalExaminationFactory::new();
    }
}
