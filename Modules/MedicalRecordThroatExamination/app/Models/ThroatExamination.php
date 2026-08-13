<?php

namespace Modules\MedicalRecordThroatExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordThroatExamination\Database\Factories\ThroatExaminationFactory;

class ThroatExamination extends Model
{
    use HasFactory;

    protected $table = 'throat_examinations';

    protected $fillable = [
        'visit_id',
        'pharynx',
        'uvula',
        'mucosa',
        'exudate',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'exudate' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): ThroatExaminationFactory
    {
        return ThroatExaminationFactory::new();
    }
}
