<?php

namespace Modules\PembayaranInvoiceMerge\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceMerge\Database\Factories\InvoiceMergeFactory;
use Modules\PembayaranPayment\Models\Payment;

class InvoiceMerge extends Model
{
    use HasFactory;

    protected $fillable = [
        'merge_number',
        'payment_id',
        'invoice_id',
        'allocated_amount',
        'merged_by',
        'merged_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'allocated_amount' => 'decimal:2',
            'merged_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function mergedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'merged_by');
    }

    /**
     * Format: MRG-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateMergeNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('merge_number', 'like', "MRG-{$year}-%")->count();

        return sprintf('MRG-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): InvoiceMergeFactory
    {
        return InvoiceMergeFactory::new();
    }
}
