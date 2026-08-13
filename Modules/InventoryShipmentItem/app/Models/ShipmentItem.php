<?php

namespace Modules\InventoryShipmentItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryShipment\Models\Shipment;
use Modules\InventoryShipmentItem\Database\Factories\ShipmentItemFactory;

class ShipmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'item_id',
        'quantity',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): ShipmentItemFactory
    {
        return ShipmentItemFactory::new();
    }
}
