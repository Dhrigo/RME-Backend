<?php

namespace Modules\InventoryGoodsReturnItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventoryGoodsReturnItem\Database\Factories\GoodsReturnItemFactory;
use Modules\InventoryItem\Models\Item;

class GoodsReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_return_id',
        'item_id',
        'quantity',
        'unit_price',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
        ];
    }

    public function goodsReturn(): BelongsTo
    {
        return $this->belongsTo(GoodsReturn::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): GoodsReturnItemFactory
    {
        return GoodsReturnItemFactory::new();
    }
}
