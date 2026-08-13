<?php

namespace Modules\PenjualanSaleReturn\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PenjualanSale\Models\Sale;
use Modules\PenjualanSaleReturn\Database\Factories\SaleReturnFactory;

class SaleReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'returned_at',
        'reason',
        'refund_amount',
    ];

    protected function casts(): array
    {
        return [
            'returned_at' => 'datetime',
            'refund_amount' => 'decimal:2',
        ];
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    protected static function newFactory(): SaleReturnFactory
    {
        return SaleReturnFactory::new();
    }
}
