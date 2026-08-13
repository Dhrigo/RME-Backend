<?php

namespace Modules\MedicalRecordUpperGiTractExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordUpperGiTractExamination\Database\Factories\UpperGiTractExaminationFactory;

class UpperGiTractExamination extends Model
{
    use HasFactory;

    protected $table = 'upper_gi_tract_examinations';

    protected $fillable = [
        'visit_id',
        'procedure_type',
        'esophagus_findings',
        'stomach_findings',
        'duodenum_findings',
        'hpylori_result',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): UpperGiTractExaminationFactory
    {
        return UpperGiTractExaminationFactory::new();
    }
}
