<?php

namespace Modules\MedicalRecordChiefComplaint\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordChiefComplaint\Database\Factories\ChiefComplaintFactory;

class ChiefComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'complaint',
        'onset',
        'duration',
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

    protected static function newFactory(): ChiefComplaintFactory
    {
        return ChiefComplaintFactory::new();
    }
}
