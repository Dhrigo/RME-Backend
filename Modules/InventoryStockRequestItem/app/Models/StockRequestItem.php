<?php

namespace Modules\InventoryStockRequestItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;
use Modules\InventoryStockRequestItem\Database\Factories\StockRequestItemFactory;

/**
 * Multi-line breakdown for a stock request - deferred at the time InventoryStockRequest
 * was scaffolded (its own item_id/quantity cover the common single-item case).
 */
class StockRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_request_id',
        'item_id',
        'quantity',
    ];

    public function stockRequest(): BelongsTo
    {
        return $this->belongsTo(StockRequest::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): StockRequestItemFactory
    {
        return StockRequestItemFactory::new();
    }
}
