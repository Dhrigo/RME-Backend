<?php

namespace Modules\MedicalRecordHairExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordHairExamination\Database\Factories\HairExaminationFactory;

class HairExamination extends Model
{
    use HasFactory;

    protected $table = 'hair_examinations';

    protected $fillable = [
        'visit_id',
        'distribution',
        'texture',
        'color',
        'hair_loss',
        'scalp_condition',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'hair_loss' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): HairExaminationFactory
    {
        return HairExaminationFactory::new();
    }
}
