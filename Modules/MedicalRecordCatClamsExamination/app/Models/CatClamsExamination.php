<?php

namespace Modules\MedicalRecordCatClamsExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordCatClamsExamination\Database\Factories\CatClamsExaminationFactory;

class CatClamsExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_clams_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'cat_score',
        'clams_score',
        'developmental_quotient',
        'developmental_age_months',
        'interpretation',
        'examined_at',
    ];

    protected $casts = [
        'cat_score' => 'float',
        'clams_score' => 'float',
        'developmental_quotient' => 'float',
        'developmental_age_months' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): CatClamsExaminationFactory
    {
        return CatClamsExaminationFactory::new();
    }
}
