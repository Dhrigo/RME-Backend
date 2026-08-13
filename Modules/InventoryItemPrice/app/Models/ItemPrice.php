<?php

namespace Modules\InventoryItemPrice\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryItemPrice\Database\Factories\ItemPriceFactory;

class ItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'price',
        'effective_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): ItemPriceFactory
    {
        return ItemPriceFactory::new();
    }
}
