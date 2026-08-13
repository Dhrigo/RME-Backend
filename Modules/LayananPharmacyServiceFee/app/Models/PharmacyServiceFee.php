<?php

namespace Modules\LayananPharmacyServiceFee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use Modules\LayananPharmacyServiceFee\Database\Factories\PharmacyServiceFeeFactory;

class PharmacyServiceFee extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_service_fees';

    protected $fillable = [
        'item_id',
        'fee_name',
        'amount',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): PharmacyServiceFeeFactory
    {
        return PharmacyServiceFeeFactory::new();
    }
}
