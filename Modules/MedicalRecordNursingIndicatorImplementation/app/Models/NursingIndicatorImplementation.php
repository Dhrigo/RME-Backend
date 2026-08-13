<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingIndicatorImplementation\Database\Factories\NursingIndicatorImplementationFactory;

class NursingIndicatorImplementation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nursing_indicator_id',
        'visit_id',
        'value_recorded',
        'recorded_by',
        'recorded_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function nursingIndicator(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordNursingIndicator\Models\NursingIndicator::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): NursingIndicatorImplementationFactory
    {
        return NursingIndicatorImplementationFactory::new();
    }
}
