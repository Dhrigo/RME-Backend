<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPrescriptionFrequencyRule\Models\PrescriptionFrequencyRule;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Database\Factories\PrescriptionFrequencyRuleCategoryFactory;

class PrescriptionFrequencyRuleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_frequency_rule_id',
        'category_name',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function prescriptionFrequencyRule(): BelongsTo
    {
        return $this->belongsTo(PrescriptionFrequencyRule::class);
    }

    protected static function newFactory(): PrescriptionFrequencyRuleCategoryFactory
    {
        return PrescriptionFrequencyRuleCategoryFactory::new();
    }
}
