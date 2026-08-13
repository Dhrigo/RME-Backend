<?php

namespace Modules\InventoryShipment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryShipment\Database\Factories\ShipmentFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_ward_id',
        'to_ward_id',
        'shipped_by',
        'shipped_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'shipped_at' => 'datetime',
        ];
    }

    public function fromWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'from_ward_id');
    }

    public function toWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'to_ward_id');
    }

    public function shippedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'shipped_by');
    }

    protected static function newFactory(): ShipmentFactory
    {
        return ShipmentFactory::new();
    }
}
