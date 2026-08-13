<?php

namespace Modules\MedicalRecordTranscranialDopplerExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordTranscranialDopplerExamination\Database\Factories\TranscranialDopplerExaminationFactory;

class TranscranialDopplerExamination extends Model
{
    use HasFactory;

    protected $table = 'transcranial_doppler_examinations';

    protected $fillable = [
        'visit_id',
        'indication',
        'vessel',
        'mean_velocity_cm_s',
        'pulsatility_index',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): TranscranialDopplerExaminationFactory
    {
        return TranscranialDopplerExaminationFactory::new();
    }
}
