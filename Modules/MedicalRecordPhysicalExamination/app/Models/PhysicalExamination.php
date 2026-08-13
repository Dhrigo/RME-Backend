<?php

namespace Modules\MedicalRecordPhysicalExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordPhysicalExamination\Database\Factories\PhysicalExaminationFactory;

class PhysicalExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'physical_examinations';

    protected $fillable = [
        'visit_id',
        'general_condition',
        'consciousness_gcs',
        'head_to_toe_notes',
        'examined_by',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): PhysicalExaminationFactory
    {
        return PhysicalExaminationFactory::new();
    }
}
