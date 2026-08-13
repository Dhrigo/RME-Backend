<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordLowerGiTractExamination\Database\Factories\LowerGiTractExaminationFactory;

class LowerGiTractExamination extends Model
{
    use HasFactory;

    protected $table = 'lower_gi_tract_examinations';

    protected $fillable = [
        'visit_id',
        'procedure_type',
        'colon_findings',
        'rectum_findings',
        'polyps_found',
        'biopsy_taken',
        'examined_at',
    ];

    protected $casts = [
        'polyps_found' => 'boolean',
        'biopsy_taken' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): LowerGiTractExaminationFactory
    {
        return LowerGiTractExaminationFactory::new();
    }
}
