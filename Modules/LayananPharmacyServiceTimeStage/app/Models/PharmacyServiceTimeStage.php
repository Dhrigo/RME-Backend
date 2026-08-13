<?php

namespace Modules\LayananPharmacyServiceTimeStage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;
use Modules\LayananPharmacyServiceTimeStage\Database\Factories\PharmacyServiceTimeStageFactory;

class PharmacyServiceTimeStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_service_time_id',
        'stage_name',
        'recorded_at',
        'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function pharmacyServiceTime(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): PharmacyServiceTimeStageFactory
    {
        return PharmacyServiceTimeStageFactory::new();
    }
}
