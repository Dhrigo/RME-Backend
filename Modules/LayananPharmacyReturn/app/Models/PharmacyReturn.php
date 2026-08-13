<?php

namespace Modules\LayananPharmacyReturn\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPharmacyReturn\Database\Factories\PharmacyReturnFactory;

class PharmacyReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_item_id',
        'quantity_returned',
        'reason',
        'returned_by',
        'returned_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'returned_at' => 'datetime',
        ];
    }

    public function prescriptionItem(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescriptionItem\Models\PrescriptionItem::class);
    }

    public function returnedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'returned_by');
    }

    protected static function newFactory(): PharmacyReturnFactory
    {
        return PharmacyReturnFactory::new();
    }
}
