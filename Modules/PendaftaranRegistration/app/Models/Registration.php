<?php

namespace Modules\PendaftaranRegistration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralPackage\Models\Package;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Models\Referral;
use Modules\PendaftaranRegistration\Database\Factories\RegistrationFactory;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'patient_id',
        'registered_at',
        'admission_diagnosis_id',
        'referral_id',
        'package_id',
        'is_emergency',
        'has_fall_risk',
        'newborn_weight_grams',
        'newborn_length_cm',
        'birth_time',
        'found_location',
        'found_at',
        'satu_sehat_consent',
        'registered_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
            'is_emergency' => 'boolean',
            'has_fall_risk' => 'boolean',
            'found_at' => 'datetime',
            'satu_sehat_consent' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function admissionDiagnosis(): BelongsTo
    {
        return $this->belongsTo(DiagnosisCode::class, 'admission_diagnosis_id');
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Format: REG-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateRegistrationNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('registration_number', 'like', "REG-{$year}-%")->count();

        return sprintf('REG-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): RegistrationFactory
    {
        return RegistrationFactory::new();
    }
}
