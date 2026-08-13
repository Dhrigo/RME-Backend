<?php

namespace Modules\MedicalRecordObstetrics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordObstetrics\Database\Factories\ObstetricsFactory;

class Obstetrics extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'obstetrics_records';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'gravida',
        'para',
        'abortus',
        'gestational_age_weeks',
        'fundal_height_cm',
        'fetal_heart_rate',
        'fetal_presentation',
        'estimated_fetal_weight',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'gestational_age_weeks' => 'float',
        'fundal_height_cm' => 'float',
        'fetal_heart_rate' => 'integer',
        'estimated_fetal_weight' => 'integer',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ObstetricsFactory
    {
        return ObstetricsFactory::new();
    }
}
