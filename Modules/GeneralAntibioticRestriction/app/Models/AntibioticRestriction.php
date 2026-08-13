<?php

namespace Modules\GeneralAntibioticRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralAntibioticRestriction\Database\Factories\AntibioticRestrictionFactory;

class AntibioticRestriction extends Model
{
    use HasFactory;

    public const AWARE_CATEGORIES = ['access', 'watch', 'reserve'];

    protected $fillable = [
        'antibiotic_name',
        'aware_category',
        'requires_pra_approval',
        'restriction_condition',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'requires_pra_approval' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): AntibioticRestrictionFactory
    {
        return AntibioticRestrictionFactory::new();
    }
}
