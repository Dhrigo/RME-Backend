<?php

namespace Modules\MedicalRecordToeExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordToeExamination\Database\Factories\ToeExaminationFactory;

class ToeExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'toe_examinations';

    protected $fillable = [
        'visit_id',
        'foot_side',
        'deformity',
        'ulceration',
        'capillary_refill_seconds',
        'sensation_monofilament',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'ulceration' => 'boolean',
        'capillary_refill_seconds' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ToeExaminationFactory
    {
        return ToeExaminationFactory::new();
    }
}
