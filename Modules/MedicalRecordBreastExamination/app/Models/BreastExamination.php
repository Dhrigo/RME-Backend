<?php

namespace Modules\MedicalRecordBreastExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordBreastExamination\Database\Factories\BreastExaminationFactory;

class BreastExamination extends Model
{
    use HasFactory;

    protected $table = 'breast_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'inspection',
        'palpation',
        'lump_present',
        'nipple_discharge',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'lump_present' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): BreastExaminationFactory
    {
        return BreastExaminationFactory::new();
    }
}
