<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralWard\Models\Ward;
use \Modules\InventoryItem\Models\Item;
use Modules\GeneralPrescriptionOriginUnitRestriction\Database\Factories\PrescriptionOriginUnitRestrictionFactory;

class PrescriptionOriginUnitRestriction extends Model
{
    use HasFactory;

    protected $table = 'prescription_origin_unit_restrictions';

    protected $fillable = [
        'ward_id',
        'item_id',
        'is_allowed',
        'note',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_allowed' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): PrescriptionOriginUnitRestrictionFactory
    {
        return PrescriptionOriginUnitRestrictionFactory::new();
    }
}
