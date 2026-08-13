<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;
use Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Database\Factories\ProcedureConsentPatientAcknowledgementFactory;

class ProcedureConsentPatientAcknowledgement extends Model
{
    use HasFactory;

    protected $table = 'procedure_consent_patient_acknowledgements';

    protected $fillable = [
        'consent_id',
        'acknowledger_name',
        'relationship_to_patient',
        'decision',
        'signed_at',
    ];

    protected function casts(): array
    {
        return [
            'signed_at' => 'datetime',
        ];
    }

    public function consent(): BelongsTo
    {
        return $this->belongsTo(DoctorProcedureConsent::class, 'consent_id');
    }

    protected static function newFactory(): ProcedureConsentPatientAcknowledgementFactory
    {
        return ProcedureConsentPatientAcknowledgementFactory::new();
    }
}
