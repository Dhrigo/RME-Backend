<?php

namespace Modules\PembayaranTransfer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PembayaranTransfer\Database\Factories\TransferFactory;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'bank_transfers';

    protected $fillable = [
        'payment_id',
        'transfer_reference_number',
        'source_bank_name',
        'destination_account_number',
        'destination_account_name',
        'amount',
        'transferred_at',
        'proof_file_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transferred_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    protected static function newFactory(): TransferFactory
    {
        return TransferFactory::new();
    }
}
