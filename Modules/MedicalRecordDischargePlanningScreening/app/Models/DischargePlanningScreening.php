<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDischargePlanningScreening\Database\Factories\DischargePlanningScreeningFactory;

class DischargePlanningScreening extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'screening_criteria',
        'total_score',
        'requires_planning',
        'screened_by',
        'screened_at',
    ];

    protected function casts(): array
    {
        return [
            'requires_planning' => 'boolean',
            'screened_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function screenedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'screened_by');
    }

    protected static function newFactory(): DischargePlanningScreeningFactory
    {
        return DischargePlanningScreeningFactory::new();
    }
}
