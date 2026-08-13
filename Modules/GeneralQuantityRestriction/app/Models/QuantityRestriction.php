<?php

namespace Modules\GeneralQuantityRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralQuantityRestriction\Database\Factories\QuantityRestrictionFactory;

class QuantityRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_name',
        'max_quantity_per_prescription',
        'unit',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'max_quantity_per_prescription' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): QuantityRestrictionFactory
    {
        return QuantityRestrictionFactory::new();
    }
}
