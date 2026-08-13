<?php

namespace Modules\InventoryWardStockTransaction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardStockTransaction\Database\Factories\WardStockTransactionFactory;

class WardStockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'item_id',
        'type',
        'quantity',
        'performed_by',
        'performed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    protected static function newFactory(): WardStockTransactionFactory
    {
        return WardStockTransactionFactory::new();
    }
}
