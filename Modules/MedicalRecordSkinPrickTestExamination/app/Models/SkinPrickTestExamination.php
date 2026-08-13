<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordSkinPrickTestExamination\Database\Factories\SkinPrickTestExaminationFactory;

class SkinPrickTestExamination extends Model
{
    use HasFactory;

    protected $table = 'skin_prick_test_examinations';

    protected $fillable = [
        'visit_id',
        'allergen',
        'wheal_size_mm',
        'flare_size_mm',
        'result',
        'reaction_onset_minutes',
        'notes',
        'tested_at',
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    protected static function newFactory(): SkinPrickTestExaminationFactory
    {
        return SkinPrickTestExaminationFactory::new();
    }
}
