<?php

namespace Modules\MedicalRecordImmunizationVaccination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImmunizationVaccination\Database\Factories\ImmunizationVaccinationFactory;

class ImmunizationVaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_id',
        'vaccine_name',
        'dose_number',
        'batch_number',
        'administered_at',
        'administered_by',
        'site',
        'route',
        'adverse_reaction',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'administered_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralPatient\Models\Patient::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function administeredBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'administered_by');
    }

    protected static function newFactory(): ImmunizationVaccinationFactory
    {
        return ImmunizationVaccinationFactory::new();
    }
}
