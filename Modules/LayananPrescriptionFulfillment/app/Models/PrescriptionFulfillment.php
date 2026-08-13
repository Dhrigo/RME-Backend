<?php

namespace Modules\LayananPrescriptionFulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionFulfillment\Database\Factories\PrescriptionFulfillmentFactory;

class PrescriptionFulfillment extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'served_by',
        'served_at',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'served_at' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescription\Models\Prescription::class);
    }

    public function servedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'served_by');
    }

    protected static function newFactory(): PrescriptionFulfillmentFactory
    {
        return PrescriptionFulfillmentFactory::new();
    }
}
