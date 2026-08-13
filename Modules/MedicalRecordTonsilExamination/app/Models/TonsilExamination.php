<?php

namespace Modules\MedicalRecordTonsilExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordTonsilExamination\Database\Factories\TonsilExaminationFactory;

class TonsilExamination extends Model
{
    use HasFactory;

    protected $table = 'tonsil_examinations';

    protected $fillable = [
        'visit_id',
        'side',
        'grade',
        'color',
        'exudate',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'exudate' => 'boolean',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): TonsilExaminationFactory
    {
        return TonsilExaminationFactory::new();
    }
}
