<?php

namespace Modules\PembayaranPayment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Database\Factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'invoice_id',
        'payment_method',
        'amount',
        'admin_fee',
        'paid_at',
        'received_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'admin_fee' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Format: PAY-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generatePaymentNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('payment_number', 'like', "PAY-{$year}-%")->count();

        return sprintf('PAY-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }
}
