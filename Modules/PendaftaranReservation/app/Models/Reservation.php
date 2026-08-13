<?php

namespace Modules\PendaftaranReservation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranReservation\Database\Factories\ReservationFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'ward_id',
        'reserved_at',
        'scheduled_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'reserved_at' => 'datetime',
            'scheduled_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): ReservationFactory
    {
        return ReservationFactory::new();
    }
}
