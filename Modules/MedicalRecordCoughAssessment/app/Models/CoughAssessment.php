<?php

namespace Modules\MedicalRecordCoughAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordCoughAssessment\Database\Factories\CoughAssessmentFactory;

class CoughAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'has_cough',
        'duration_weeks',
        'cough_type',
        'other_symptoms',
        'is_referred_tb_screening',
        'assessed_by',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'has_cough' => 'boolean',
            'is_referred_tb_screening' => 'boolean',
            'assessed_at' => 'datetime',
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

    protected static function newFactory(): CoughAssessmentFactory
    {
        return CoughAssessmentFactory::new();
    }
}
