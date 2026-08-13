<?php

namespace Modules\InventoryReceivingRecord\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryReceivingRecord\Database\Factories\ReceivingRecordFactory;

/**
 * General receiving into a ward - distinct from InventoryGoodsReceipt (GoodsReceipt),
 * which is specifically a supplier-sourced single-item receipt. This is header-only;
 * line items live in InventoryReceivingItem (ReceivingItem).
 */
class ReceivingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'received_by',
        'received_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'received_at' => 'datetime',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'received_by');
    }

    protected static function newFactory(): ReceivingRecordFactory
    {
        return ReceivingRecordFactory::new();
    }
}
