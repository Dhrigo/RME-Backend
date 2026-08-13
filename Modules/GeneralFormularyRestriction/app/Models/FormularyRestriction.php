<?php

namespace Modules\GeneralFormularyRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralFormularyRestriction\Database\Factories\FormularyRestrictionFactory;

class FormularyRestriction extends Model
{
    use HasFactory;

    public const FORMULARY_CATEGORIES = ['fornas', 'formularium_rs', 'non_formularium'];

    protected $fillable = [
        'drug_name',
        'formulary_category',
        'requires_substitution',
        'substitution_drug_name',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'requires_substitution' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): FormularyRestrictionFactory
    {
        return FormularyRestrictionFactory::new();
    }
}
