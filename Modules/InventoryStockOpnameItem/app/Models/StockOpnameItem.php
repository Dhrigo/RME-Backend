<?php

namespace Modules\InventoryStockOpnameItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockOpname\Models\StockOpname;
use Modules\InventoryStockOpnameItem\Database\Factories\StockOpnameItemFactory;

class StockOpnameItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_opname_id',
        'item_id',
        'system_quantity',
        'physical_quantity',
        'difference',
    ];

    protected function casts(): array
    {
        return [
            'system_quantity' => 'integer',
            'physical_quantity' => 'integer',
            'difference' => 'integer',
        ];
    }

    public function stockOpname(): BelongsTo
    {
        return $this->belongsTo(StockOpname::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): StockOpnameItemFactory
    {
        return StockOpnameItemFactory::new();
    }
}
