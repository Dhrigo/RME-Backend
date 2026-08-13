<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPrescriptionFrequencyRule\Database\Factories\PrescriptionFrequencyRuleFactory;

class PrescriptionFrequencyRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'times_per_day',
        'interval_hours',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'times_per_day' => 'integer',
            'interval_hours' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): PrescriptionFrequencyRuleFactory
    {
        return PrescriptionFrequencyRuleFactory::new();
    }
}
