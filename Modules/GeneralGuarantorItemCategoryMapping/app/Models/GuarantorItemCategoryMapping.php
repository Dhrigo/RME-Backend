<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralGuarantorItemCategoryMapping\Database\Factories\GuarantorItemCategoryMappingFactory;
use Modules\InventoryItemCategory\Models\ItemCategory;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorItemCategoryMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'guarantor_id',
        'item_category_id',
        'is_covered',
        'coverage_percentage',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_covered' => 'boolean',
            'coverage_percentage' => 'decimal:2',
        ];
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    public function itemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    protected static function newFactory(): GuarantorItemCategoryMappingFactory
    {
        return GuarantorItemCategoryMappingFactory::new();
    }
}
