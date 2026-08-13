<?php

namespace Modules\LayananAntimicrobialStewardshipFormItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use \Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipFormItem\Database\Factories\AntimicrobialStewardshipFormItemFactory;

class AntimicrobialStewardshipFormItem extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_form_items';

    protected $fillable = [
        'antimicrobial_stewardship_form_id',
        'item_id',
        'dose',
        'route',
        'frequency',
        'planned_duration_days',
    ];

    public function antimicrobialStewardshipForm(): BelongsTo
    {
        return $this->belongsTo(AntimicrobialStewardshipForm::class, 'antimicrobial_stewardship_form_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): AntimicrobialStewardshipFormItemFactory
    {
        return AntimicrobialStewardshipFormItemFactory::new();
    }
}
