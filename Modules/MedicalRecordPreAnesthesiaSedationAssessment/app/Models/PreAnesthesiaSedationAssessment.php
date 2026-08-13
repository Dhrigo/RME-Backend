<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Database\Factories\PreAnesthesiaSedationAssessmentFactory;

class PreAnesthesiaSedationAssessment extends Model
{
    use HasFactory;

    protected $table = 'pre_anesthesia_sedation_assessments';

    protected $fillable = [
        'visit_id',
        'doctor_id',
        'created_by',
        'asa_classification',
        'mallampati_class',
        'npo_hours',
        'comorbidities',
        'planned_anesthesia_type',
        'risk_notes',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): PreAnesthesiaSedationAssessmentFactory
    {
        return PreAnesthesiaSedationAssessmentFactory::new();
    }
}
