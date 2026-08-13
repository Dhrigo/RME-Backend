<?php

namespace Modules\MedicalRecordSocialCondition\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordSocialCondition\Database\Factories\SocialConditionFactory;

class SocialCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'living_situation',
        'occupation_status',
        'financial_status',
        'support_system',
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

    protected static function newFactory(): SocialConditionFactory
    {
        return SocialConditionFactory::new();
    }
}
