<?php

namespace Modules\MedicalRecordExternalRiskFactor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordExternalRiskFactor\Database\Factories\ExternalRiskFactorFactory;

class ExternalRiskFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'factor_type',
        'description',
        'impact_level',
        'recorded_by',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): ExternalRiskFactorFactory
    {
        return ExternalRiskFactorFactory::new();
    }
}
