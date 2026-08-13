<?php

namespace Modules\LayananPharmacyServiceTime\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPharmacyServiceTime\Database\Factories\PharmacyServiceTimeFactory;

class PharmacyServiceTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'received_at',
        'prepared_at',
        'dispensed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'received_at' => 'datetime',
            'prepared_at' => 'datetime',
            'dispensed_at' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescription\Models\Prescription::class);
    }

    protected static function newFactory(): PharmacyServiceTimeFactory
    {
        return PharmacyServiceTimeFactory::new();
    }
}
