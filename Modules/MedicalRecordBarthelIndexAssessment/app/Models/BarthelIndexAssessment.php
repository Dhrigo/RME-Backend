<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordBarthelIndexAssessment\Database\Factories\BarthelIndexAssessmentFactory;

class BarthelIndexAssessment extends Model
{
    use HasFactory;

    protected $table = 'barthel_index_assessments';

    protected $fillable = [
        'visit_id',
        'feeding',
        'bathing',
        'grooming',
        'dressing',
        'bowel_control',
        'bladder_control',
        'toilet_use',
        'transfers',
        'mobility',
        'stairs',
        'total_score',
        'interpretation',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): BarthelIndexAssessmentFactory
    {
        return BarthelIndexAssessmentFactory::new();
    }
}
