<?php

namespace Modules\PembayaranInvoice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Database\Factories\InvoiceFactory;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PendaftaranVisit\Models\Visit;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'visit_id',
        'invoice_date',
        'subtotal',
        'rounding_adjustment',
        'total_amount',
        'is_locked',
        'created_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'invoice_date' => 'datetime',
            'subtotal' => 'decimal:2',
            'rounding_adjustment' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'is_locked' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Recalculate subtotal/total from current line items. Call after any item
     * create/update/delete - not automatic, callers are responsible for invoking it.
     */
    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        $this->update([
            'subtotal' => $subtotal,
            'total_amount' => $subtotal + $this->rounding_adjustment,
        ]);
    }

    /**
     * Format: INV-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateInvoiceNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('invoice_number', 'like', "INV-{$year}-%")->count();

        return sprintf('INV-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): InvoiceFactory
    {
        return InvoiceFactory::new();
    }
}
