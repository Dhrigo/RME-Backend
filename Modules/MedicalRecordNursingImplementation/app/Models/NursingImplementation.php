<?php

namespace Modules\MedicalRecordNursingImplementation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis;
use Modules\MedicalRecordNursingImplementation\Database\Factories\NursingImplementationFactory;

class NursingImplementation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nursing_diagnosis_id',
        'action_taken',
        'performed_by',
        'performed_at',
        'patient_response',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function nursingDiagnosis(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'performed_by');
    }

    protected static function newFactory(): NursingImplementationFactory
    {
        return NursingImplementationFactory::new();
    }
}
