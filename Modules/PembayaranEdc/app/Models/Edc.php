<?php

namespace Modules\PembayaranEdc\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranEdc\Database\Factories\EdcFactory;
use Modules\PembayaranPayment\Models\Payment;

class Edc extends Model
{
    use HasFactory;

    protected $table = 'edc_transactions';

    public const CARD_TYPES = ['debit', 'credit'];

    protected $fillable = [
        'payment_id',
        'edc_reference_number',
        'bank_name',
        'card_type',
        'card_last_four',
        'approval_code',
        'amount',
        'transaction_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    protected static function newFactory(): EdcFactory
    {
        return EdcFactory::new();
    }
}
