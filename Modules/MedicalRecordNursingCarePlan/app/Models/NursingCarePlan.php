<?php

namespace Modules\MedicalRecordNursingCarePlan\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingCarePlan\Database\Factories\NursingCarePlanFactory;

class NursingCarePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'assessment',
        'goal',
        'intervention_plan',
        'target_date',
        'recorded_by',
        'recorded_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): NursingCarePlanFactory
    {
        return NursingCarePlanFactory::new();
    }
}
