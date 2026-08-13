<?php

namespace Modules\MedicalRecordLipExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordLipExamination\Database\Factories\LipExaminationFactory;

class LipExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lip_examinations';

    protected $fillable = [
        'visit_id',
        'color',
        'symmetry',
        'lesions',
        'moisture',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): LipExaminationFactory
    {
        return LipExaminationFactory::new();
    }
}
