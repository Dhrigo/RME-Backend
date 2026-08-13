<?php

namespace Modules\InventoryMinimumStockLevel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryMinimumStockLevel\Database\Factories\MinimumStockLevelFactory;

class MinimumStockLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'ward_id',
        'minimum_quantity',
    ];

    protected function casts(): array
    {
        return [
            'minimum_quantity' => 'integer',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): MinimumStockLevelFactory
    {
        return MinimumStockLevelFactory::new();
    }
}
