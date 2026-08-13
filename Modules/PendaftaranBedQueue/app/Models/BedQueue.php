<?php

namespace Modules\PendaftaranBedQueue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranBedQueue\Database\Factories\BedQueueFactory;

class BedQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'bed_id',
        'patient_id',
        'queue_number',
        'status',
    ];

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): BedQueueFactory
    {
        return BedQueueFactory::new();
    }
}
