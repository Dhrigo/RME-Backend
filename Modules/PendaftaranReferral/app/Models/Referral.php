<?php

namespace Modules\PendaftaranReferral\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Database\Factories\ReferralFactory;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_number',
        'patient_id',
        'direction',
        'facility_name',
        'reason',
        'referred_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'referred_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Format: RUJ-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateReferralNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('referral_number', 'like', "RUJ-{$year}-%")->count();

        return sprintf('RUJ-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): ReferralFactory
    {
        return ReferralFactory::new();
    }
}
