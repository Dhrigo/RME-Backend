<?php

namespace Modules\MedicalRecordKillipClassAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordKillipClassAssessment\Database\Factories\KillipClassAssessmentFactory;

class KillipClassAssessment extends Model
{
    use HasFactory;

    protected $table = 'killip_class_assessments';

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'killip_class',
        'heart_rate',
        'respiratory_rate',
        'rales_present',
        's3_gallop_present',
        'notes',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'rales_present' => 'boolean',
            's3_gallop_present' => 'boolean',
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): KillipClassAssessmentFactory
    {
        return KillipClassAssessmentFactory::new();
    }
}
