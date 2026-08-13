<?php

namespace Modules\MedicalRecordPalateExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordPalateExamination\Database\Factories\PalateExaminationFactory;

class PalateExamination extends Model
{
    use HasFactory;

    protected $table = 'palate_examinations';

    protected $fillable = [
        'visit_id',
        'hard_palate',
        'soft_palate',
        'uvula_position',
        'cleft_palate',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'cleft_palate' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): PalateExaminationFactory
    {
        return PalateExaminationFactory::new();
    }
}
