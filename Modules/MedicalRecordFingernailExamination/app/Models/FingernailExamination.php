<?php

namespace Modules\MedicalRecordFingernailExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordFingernailExamination\Database\Factories\FingernailExaminationFactory;

class FingernailExamination extends Model
{
    use HasFactory;

    protected $table = 'fingernail_examinations';

    protected $fillable = [
        'visit_id',
        'color',
        'capillary_refill_seconds',
        'clubbing',
        'cyanosis',
        'lesions',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'clubbing' => 'boolean',
        'cyanosis' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): FingernailExaminationFactory
    {
        return FingernailExaminationFactory::new();
    }
}
