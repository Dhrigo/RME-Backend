<?php

namespace Modules\InventoryReceivingItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryReceivingItem\Database\Factories\ReceivingItemFactory;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;

class ReceivingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiving_record_id',
        'item_id',
        'quantity',
        'unit_price',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
        ];
    }

    public function receivingRecord(): BelongsTo
    {
        return $this->belongsTo(ReceivingRecord::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): ReceivingItemFactory
    {
        return ReceivingItemFactory::new();
    }
}
