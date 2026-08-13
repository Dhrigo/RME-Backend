<?php

namespace Modules\PembayaranPatientReceivableSettlement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Modules\PembayaranPatientReceivableSettlement\Database\Factories\PatientReceivableSettlementFactory;

class PatientReceivableSettlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_receivable_id',
        'paid_amount',
        'paid_at',
        'received_by',
    ];

    protected function casts(): array
    {
        return [
            'paid_amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function patientReceivable(): BelongsTo
    {
        return $this->belongsTo(PatientReceivable::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    protected static function newFactory(): PatientReceivableSettlementFactory
    {
        return PatientReceivableSettlementFactory::new();
    }
}
