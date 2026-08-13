<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralGuarantorItemCategoryMapping\Models\GuarantorItemCategoryMapping;
use Modules\InventoryItemCategory\Models\ItemCategory;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorItemCategoryMappingFactory extends Factory
{
    protected $model = GuarantorItemCategoryMapping::class;

    public function definition(): array
    {
        return [
            'guarantor_id' => Guarantor::factory(),
            'item_category_id' => ItemCategory::factory(),
            'is_covered' => true,
            'coverage_percentage' => 100,
            'notes' => null,
        ];
    }
}
