<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;
use Modules\MedicalRecordNursingCarePlanImplementation\Database\Factories\NursingCarePlanImplementationFactory;

class NursingCarePlanImplementation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nursing_care_plan_id',
        'action_taken',
        'performed_by',
        'performed_at',
        'evaluation',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function nursingCarePlan(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'performed_by');
    }

    protected static function newFactory(): NursingCarePlanImplementationFactory
    {
        return NursingCarePlanImplementationFactory::new();
    }
}
