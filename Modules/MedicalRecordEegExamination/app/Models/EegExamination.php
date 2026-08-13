<?php

namespace Modules\MedicalRecordEegExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordEegExamination\Database\Factories\EegExaminationFactory;

class EegExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'eeg_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'background_rhythm',
        'epileptiform_discharges',
        'abnormality_type',
        'clinical_correlation',
        'conclusion',
        'examined_at',
    ];

    protected $casts = [
        'epileptiform_discharges' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): EegExaminationFactory
    {
        return EegExaminationFactory::new();
    }
}
