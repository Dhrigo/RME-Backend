<?php

namespace Modules\MedicalRecordRadiologyResultSummary\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordRadiologyResultSummary\Database\Factories\RadiologyResultSummaryFactory;

class RadiologyResultSummary extends Model
{
    use HasFactory;

    protected $table = 'radiology_result_summaries';

    protected $fillable = [
        'visit_id',
        'summarized_by',
        'created_by',
        'overall_impression',
        'summarized_at',
    ];

    protected function casts(): array
    {
        return [
            'summarized_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function summarizedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'summarized_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): RadiologyResultSummaryFactory
    {
        return RadiologyResultSummaryFactory::new();
    }
}
