<?php

namespace Modules\LayananLeftoverMedicationVoucher\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\LayananPrescription\Models\Prescription;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananLeftoverMedicationVoucher\Database\Factories\LeftoverMedicationVoucherFactory;

class LeftoverMedicationVoucher extends Model
{
    use HasFactory;

    protected $table = 'leftover_medication_vouchers';

    public const STATUSS = ['pending', 'redeemed', 'expired'];

    protected $fillable = [
        'voucher_number',
        'visit_id',
        'patient_id',
        'prescription_id',
        'status',
        'issued_at',
        'redeemed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
            'redeemed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    protected static function newFactory(): LeftoverMedicationVoucherFactory
    {
        return LeftoverMedicationVoucherFactory::new();
    }
}
