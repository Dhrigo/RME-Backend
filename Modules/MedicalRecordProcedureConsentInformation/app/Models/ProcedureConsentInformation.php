<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;
use Modules\MedicalRecordProcedureConsentInformation\Database\Factories\ProcedureConsentInformationFactory;

class ProcedureConsentInformation extends Model
{
    use HasFactory;

    protected $table = 'procedure_consent_information';

    protected $fillable = [
        'consent_id',
        'explained_by',
        'diagnosis_explanation',
        'procedure_explanation',
        'purpose',
        'risks_and_complications',
        'alternative_procedures',
        'prognosis',
        'explained_at',
    ];

    protected function casts(): array
    {
        return [
            'explained_at' => 'datetime',
        ];
    }

    public function consent(): BelongsTo
    {
        return $this->belongsTo(DoctorProcedureConsent::class, 'consent_id');
    }

    public function explainedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'explained_by');
    }

    protected static function newFactory(): ProcedureConsentInformationFactory
    {
        return ProcedureConsentInformationFactory::new();
    }
}
