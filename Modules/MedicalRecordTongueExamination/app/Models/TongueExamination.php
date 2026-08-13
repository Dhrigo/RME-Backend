<?php

namespace Modules\MedicalRecordTongueExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordTongueExamination\Database\Factories\TongueExaminationFactory;

class TongueExamination extends Model
{
    use HasFactory;

    protected $table = 'tongue_examinations';

    protected $fillable = [
        'visit_id',
        'color',
        'coating',
        'moisture',
        'lesions',
        'movement',
        'findings',
        'examined_at',
    ];

    protected $casts = [
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): TongueExaminationFactory
    {
        return TongueExaminationFactory::new();
    }
}
