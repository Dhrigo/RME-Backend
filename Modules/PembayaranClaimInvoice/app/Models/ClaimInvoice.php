<?php

namespace Modules\PembayaranClaimInvoice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranClaimInvoice\Database\Factories\ClaimInvoiceFactory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class ClaimInvoice extends Model
{
    use HasFactory;

    public const STATUSES = ['draft', 'submitted', 'verified', 'paid', 'rejected'];

    protected $fillable = [
        'claim_number',
        'invoice_id',
        'guarantor_id',
        'claim_amount',
        'verified_amount',
        'submitted_at',
        'status',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'claim_amount' => 'decimal:2',
            'verified_amount' => 'decimal:2',
            'submitted_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    /**
     * Format: CLM-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateClaimNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('claim_number', 'like', "CLM-{$year}-%")->count();

        return sprintf('CLM-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): ClaimInvoiceFactory
    {
        return ClaimInvoiceFactory::new();
    }
}
