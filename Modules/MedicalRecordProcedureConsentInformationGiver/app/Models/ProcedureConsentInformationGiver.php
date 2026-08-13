<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDoctorProcedureConsent\Models\DoctorProcedureConsent;
use Modules\MedicalRecordProcedureConsentInformationGiver\Database\Factories\ProcedureConsentInformationGiverFactory;

class ProcedureConsentInformationGiver extends Model
{
    use HasFactory;

    protected $table = 'procedure_consent_information_givers';

    protected $fillable = [
        'consent_id',
        'giver_id',
        'giver_role',
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

    public function giver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'giver_id');
    }

    protected static function newFactory(): ProcedureConsentInformationGiverFactory
    {
        return ProcedureConsentInformationGiverFactory::new();
    }
}
