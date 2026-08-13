<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordInterventionIndicatorMapping\Database\Factories\InterventionIndicatorMappingFactory;

class InterventionIndicatorMapping extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'intervention_code',
        'intervention_name',
        'indicator_code',
        'indicator_name',
        'evaluation_criteria',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): InterventionIndicatorMappingFactory
    {
        return InterventionIndicatorMappingFactory::new();
    }
}
