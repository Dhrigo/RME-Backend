<?php

namespace Modules\MedicalRecordFunctionalAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFunctionalAssessment\Database\Factories\FunctionalAssessmentFactory;

class FunctionalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'assessment_date',
        'mobility_status',
        'adl_score',
        'assistive_device',
        'assessed_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'assessment_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'assessed_by');
    }

    protected static function newFactory(): FunctionalAssessmentFactory
    {
        return FunctionalAssessmentFactory::new();
    }
}
