<?php

namespace Modules\GeneralDurationRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralDurationRestriction\Database\Factories\DurationRestrictionFactory;

class DurationRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'antibiotic_name',
        'max_days',
        'min_days',
        'requires_reevaluation',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'max_days' => 'integer',
            'min_days' => 'integer',
            'requires_reevaluation' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): DurationRestrictionFactory
    {
        return DurationRestrictionFactory::new();
    }
}
