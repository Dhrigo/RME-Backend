<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFunctionalStatusAssessment\Database\Factories\FunctionalStatusAssessmentFactory;

class FunctionalStatusAssessment extends Model
{
    use HasFactory;

    protected $table = 'functional_status_assessments';

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'bathing_status',
        'dressing_status',
        'toileting_status',
        'transferring_status',
        'feeding_status',
        'total_score',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
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

    protected static function newFactory(): FunctionalStatusAssessmentFactory
    {
        return FunctionalStatusAssessmentFactory::new();
    }
}
