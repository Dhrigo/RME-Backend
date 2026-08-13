<?php

namespace Modules\MedicalRecordInpatientCarePlan\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordInpatientCarePlan\Database\Factories\InpatientCarePlanFactory;

class InpatientCarePlan extends Model
{
    use HasFactory;

    protected $table = 'inpatient_care_plans';

    protected $fillable = [
        'visit_id',
        'planned_by',
        'created_by',
        'care_goals',
        'planned_length_of_stay_days',
        'discharge_criteria',
        'status',
        'planned_at',
    ];

    protected function casts(): array
    {
        return [
            'planned_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function plannedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'planned_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): InpatientCarePlanFactory
    {
        return InpatientCarePlanFactory::new();
    }
}
