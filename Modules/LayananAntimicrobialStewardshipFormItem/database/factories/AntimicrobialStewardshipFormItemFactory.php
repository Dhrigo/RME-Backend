<?php

namespace Modules\LayananAntimicrobialStewardshipFormItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananAntimicrobialStewardshipFormItem\Models\AntimicrobialStewardshipFormItem;

class AntimicrobialStewardshipFormItemFactory extends Factory
{
    protected $model = AntimicrobialStewardshipFormItem::class;

    public function definition(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm::factory(),
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'dose' => fake()->words(3, true),
            'route' => fake()->words(3, true),
            'frequency' => fake()->words(3, true),
            'planned_duration_days' => fake()->numberBetween(1, 20),
        ];
    }
}
