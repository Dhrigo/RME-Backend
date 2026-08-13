<?php

namespace Modules\MedicalRecordInterventionRecommendation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordInterventionRecommendation\Database\Factories\InterventionRecommendationFactory;

class InterventionRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'source',
        'recommendation',
        'priority',
        'recommended_by',
        'recommended_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'recommended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recommendedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recommended_by');
    }

    protected static function newFactory(): InterventionRecommendationFactory
    {
        return InterventionRecommendationFactory::new();
    }
}
