<?php

namespace Modules\InventoryItemSerialNumber\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItemSerialNumber\Database\Factories\ItemSerialNumberFactory;
use Modules\InventoryWardItemStock\Models\WardItemStock;

class ItemSerialNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_item_stock_id',
        'serial_number',
        'expiry_date',
    ];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
        ];
    }

    public function wardItemStock(): BelongsTo
    {
        return $this->belongsTo(WardItemStock::class);
    }

    protected static function newFactory(): ItemSerialNumberFactory
    {
        return ItemSerialNumberFactory::new();
    }
}
