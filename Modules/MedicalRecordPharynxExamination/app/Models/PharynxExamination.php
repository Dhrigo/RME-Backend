<?php

namespace Modules\MedicalRecordPharynxExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordPharynxExamination\Database\Factories\PharynxExaminationFactory;

class PharynxExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pharynx_examinations';

    protected $fillable = [
        'visit_id',
        'mucosa_color',
        'exudate',
        'post_nasal_drip',
        'posterior_wall_condition',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'exudate' => 'boolean',
        'post_nasal_drip' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): PharynxExaminationFactory
    {
        return PharynxExaminationFactory::new();
    }
}
