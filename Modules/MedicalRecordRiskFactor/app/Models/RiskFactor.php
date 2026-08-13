<?php

namespace Modules\MedicalRecordRiskFactor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordRiskFactor\Database\Factories\RiskFactorFactory;

class RiskFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'risk_category',
        'description',
        'risk_level',
        'identified_by',
        'identified_at',
        'mitigation_plan',
    ];

    protected function casts(): array
    {
        return [
            'identified_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function identifiedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'identified_by');
    }

    protected static function newFactory(): RiskFactorFactory
    {
        return RiskFactorFactory::new();
    }
}
