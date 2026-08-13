<?php

namespace Modules\LayananMedicalSupplyUsageItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use \Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage;
use Modules\LayananMedicalSupplyUsageItem\Database\Factories\MedicalSupplyUsageItemFactory;

class MedicalSupplyUsageItem extends Model
{
    use HasFactory;

    protected $table = 'medical_supply_usage_items';

    protected $fillable = [
        'medical_supply_usage_id',
        'item_id',
        'quantity',
        'unit',
    ];

    public function medicalSupplyUsage(): BelongsTo
    {
        return $this->belongsTo(MedicalSupplyUsage::class, 'medical_supply_usage_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): MedicalSupplyUsageItemFactory
    {
        return MedicalSupplyUsageItemFactory::new();
    }
}
