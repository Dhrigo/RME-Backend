<?php

namespace Modules\LayananPrescriptionItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryItem\Models\Item;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionItem\Database\Factories\PrescriptionItemFactory;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'item_id',
        'drug_name',
        'dosage',
        'frequency',
        'route',
        'duration',
        'quantity',
        'notes',
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory(): PrescriptionItemFactory
    {
        return PrescriptionItemFactory::new();
    }
}
