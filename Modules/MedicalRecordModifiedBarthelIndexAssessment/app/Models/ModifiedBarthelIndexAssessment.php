<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Database\Factories\ModifiedBarthelIndexAssessmentFactory;

class ModifiedBarthelIndexAssessment extends Model
{
    use HasFactory;

    protected $table = 'modified_barthel_index_assessments';

    protected $fillable = [
        'visit_id',
        'feeding',
        'bathing',
        'personal_hygiene',
        'dressing',
        'bowel_control',
        'bladder_control',
        'toilet_use',
        'chair_bed_transfer',
        'ambulation',
        'stairs',
        'total_score',
        'interpretation',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): ModifiedBarthelIndexAssessmentFactory
    {
        return ModifiedBarthelIndexAssessmentFactory::new();
    }
}
