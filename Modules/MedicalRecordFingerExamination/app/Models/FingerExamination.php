<?php

namespace Modules\MedicalRecordFingerExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordFingerExamination\Database\Factories\FingerExaminationFactory;

class FingerExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'finger_examinations';

    protected $fillable = [
        'visit_id',
        'hand_side',
        'clubbing',
        'cyanosis',
        'capillary_refill_seconds',
        'range_of_motion',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'clubbing' => 'boolean',
        'cyanosis' => 'boolean',
        'capillary_refill_seconds' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): FingerExaminationFactory
    {
        return FingerExaminationFactory::new();
    }
}
