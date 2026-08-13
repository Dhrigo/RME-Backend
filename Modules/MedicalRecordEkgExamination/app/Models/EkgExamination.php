<?php

namespace Modules\MedicalRecordEkgExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordEkgExamination\Database\Factories\EkgExaminationFactory;

class EkgExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ekg_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'heart_rate_bpm',
        'rhythm',
        'p_wave',
        'pr_interval_ms',
        'qrs_duration_ms',
        'st_segment',
        't_wave',
        'conclusion',
        'examined_at',
    ];

    protected $casts = [
        'heart_rate_bpm' => 'integer',
        'pr_interval_ms' => 'integer',
        'qrs_duration_ms' => 'integer',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): EkgExaminationFactory
    {
        return EkgExaminationFactory::new();
    }
}
