<?php

namespace Modules\LayananPharmacyDispense\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPharmacyDispense\Database\Factories\PharmacyDispenseFactory;

class PharmacyDispense extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_dispenses';

    public const STATUSS = ['pending', 'dispensed', 'cancelled'];

    protected $fillable = [
        'prescription_id',
        'dispensed_by',
        'dispensed_at',
        'quantity',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'dispensed_at' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function dispensedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dispensed_by');
    }

    protected static function newFactory(): PharmacyDispenseFactory
    {
        return PharmacyDispenseFactory::new();
    }
}
