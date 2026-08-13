<?php

namespace Modules\MedicalRecordAnamnesis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordAnamnesis\Database\Factories\AnamnesisFactory;

class Anamnesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'present_illness_history',
        'past_medical_history',
        'family_medical_history',
        'allergy_history',
        'social_history',
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

    protected static function newFactory(): AnamnesisFactory
    {
        return AnamnesisFactory::new();
    }
}
