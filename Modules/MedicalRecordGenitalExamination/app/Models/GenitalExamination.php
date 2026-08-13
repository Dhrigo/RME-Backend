<?php

namespace Modules\MedicalRecordGenitalExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordGenitalExamination\Database\Factories\GenitalExaminationFactory;

class GenitalExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'genital_examinations';

    protected $fillable = [
        'visit_id',
        'external_genitalia',
        'discharge_characteristics',
        'lesions_or_masses',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): GenitalExaminationFactory
    {
        return GenitalExaminationFactory::new();
    }
}
