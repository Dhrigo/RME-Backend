<?php

namespace Modules\MedicalRecordPlanAndTherapy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPlanAndTherapy\Database\Factories\PlanAndTherapyFactory;

class PlanAndTherapy extends Model
{
    use HasFactory;

    protected $table = 'plan_and_therapies';

    protected $fillable = [
        'visit_id',
        'ordered_by',
        'created_by',
        'assessment_summary',
        'plan_description',
        'therapy_type',
        'target_date',
        'status',
        'ordered_at',
    ];

    protected function casts(): array
    {
        return [
            'target_date' => 'date',
            'ordered_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function orderedBy(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'ordered_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): PlanAndTherapyFactory
    {
        return PlanAndTherapyFactory::new();
    }
}
