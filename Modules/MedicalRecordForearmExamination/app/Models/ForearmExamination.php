<?php

namespace Modules\MedicalRecordForearmExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordForearmExamination\Database\Factories\ForearmExaminationFactory;

class ForearmExamination extends Model
{
    use HasFactory;

    protected $table = 'forearm_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'muscle_strength',
        'range_of_motion',
        'deformity',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'deformity' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ForearmExaminationFactory
    {
        return ForearmExaminationFactory::new();
    }
}
