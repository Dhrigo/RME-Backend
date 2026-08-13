<?php

namespace Modules\PembayaranPatientReceivable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPatientReceivable\Database\Factories\PatientReceivableFactory;

class PatientReceivable extends Model
{
    use HasFactory;

    public const STATUSES = ['outstanding', 'settled', 'written_off'];

    protected $fillable = [
        'invoice_id',
        'patient_id',
        'amount',
        'due_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'due_date' => 'date',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): PatientReceivableFactory
    {
        return PatientReceivableFactory::new();
    }
}
