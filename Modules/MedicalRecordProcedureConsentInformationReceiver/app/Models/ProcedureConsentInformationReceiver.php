<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;
use Modules\MedicalRecordProcedureConsentInformationReceiver\Database\Factories\ProcedureConsentInformationReceiverFactory;

class ProcedureConsentInformationReceiver extends Model
{
    use HasFactory;

    protected $table = 'procedure_consent_information_receivers';

    protected $fillable = [
        'consent_id',
        'receiver_name',
        'receiver_relationship',
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

    protected static function newFactory(): ProcedureConsentInformationReceiverFactory
    {
        return ProcedureConsentInformationReceiverFactory::new();
    }
}
