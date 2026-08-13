<?php

namespace Modules\PembayaranCorporateReceivableSettlement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranCorporateReceivableSettlement\Database\Factories\CorporateReceivableSettlementFactory;

class CorporateReceivableSettlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_receivable_id',
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

    public function corporateReceivable(): BelongsTo
    {
        return $this->belongsTo(CorporateReceivable::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    protected static function newFactory(): CorporateReceivableSettlementFactory
    {
        return CorporateReceivableSettlementFactory::new();
    }
}
