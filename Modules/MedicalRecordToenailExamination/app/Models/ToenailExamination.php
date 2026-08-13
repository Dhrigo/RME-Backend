<?php

namespace Modules\MedicalRecordToenailExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordToenailExamination\Database\Factories\ToenailExaminationFactory;

class ToenailExamination extends Model
{
    use HasFactory;

    protected $table = 'toenail_examinations';

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

    protected static function newFactory(): ToenailExaminationFactory
    {
        return ToenailExaminationFactory::new();
    }
}
