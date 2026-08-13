<?php

namespace Modules\MedicalRecordNursingIndicator\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType;
use Modules\MedicalRecordNursingIndicator\Database\Factories\NursingIndicatorFactory;

class NursingIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'nursing_indicator_type_id',
        'unit',
        'target_value',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function nursingIndicatorType(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType::class);
    }

    protected static function newFactory(): NursingIndicatorFactory
    {
        return NursingIndicatorFactory::new();
    }
}
