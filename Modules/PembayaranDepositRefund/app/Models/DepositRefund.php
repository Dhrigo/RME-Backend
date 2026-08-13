<?php

namespace Modules\PembayaranDepositRefund\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PembayaranDepositRefund\Database\Factories\DepositRefundFactory;

class DepositRefund extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_id',
        'refunded_amount',
        'refunded_at',
        'refunded_by',
    ];

    protected function casts(): array
    {
        return [
            'refunded_amount' => 'decimal:2',
            'refunded_at' => 'datetime',
        ];
    }

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }

    public function refundedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'refunded_by');
    }

    protected static function newFactory(): DepositRefundFactory
    {
        return DepositRefundFactory::new();
    }
}
