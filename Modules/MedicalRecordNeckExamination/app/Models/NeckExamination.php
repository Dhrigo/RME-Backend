<?php

namespace Modules\MedicalRecordNeckExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordNeckExamination\Database\Factories\NeckExaminationFactory;

class NeckExamination extends Model
{
    use HasFactory;

    protected $table = 'neck_examinations';

    protected $fillable = [
        'visit_id',
        'lymph_nodes',
        'thyroid',
        'jugular_venous_pressure',
        'trachea_position',
        'mass',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'mass' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): NeckExaminationFactory
    {
        return NeckExaminationFactory::new();
    }
}
