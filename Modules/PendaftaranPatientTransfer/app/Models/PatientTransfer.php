<?php

namespace Modules\PendaftaranPatientTransfer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranPatientTransfer\Database\Factories\PatientTransferFactory;
use Modules\PendaftaranVisit\Models\Visit;

class PatientTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'from_ward_id',
        'to_ward_id',
        'transferred_at',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'transferred_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function fromWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'from_ward_id');
    }

    public function toWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'to_ward_id');
    }

    protected static function newFactory(): PatientTransferFactory
    {
        return PatientTransferFactory::new();
    }
}
