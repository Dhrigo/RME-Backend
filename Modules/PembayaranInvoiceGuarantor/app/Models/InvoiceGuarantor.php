<?php

namespace Modules\PembayaranInvoiceGuarantor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Database\Factories\InvoiceGuarantorFactory;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class InvoiceGuarantor extends Model
{
    use HasFactory;

    public const VERIFICATION_STATUSES = ['pending', 'verified', 'rejected'];

    protected $fillable = [
        'invoice_id',
        'guarantor_id',
        'covered_amount',
        'coverage_percentage',
        'verification_status',
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'covered_amount' => 'decimal:2',
            'coverage_percentage' => 'decimal:2',
            'verified_at' => 'datetime',
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

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    protected static function newFactory(): InvoiceGuarantorFactory
    {
        return InvoiceGuarantorFactory::new();
    }
}
