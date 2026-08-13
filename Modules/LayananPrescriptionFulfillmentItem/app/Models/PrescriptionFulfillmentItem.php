<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPrescriptionFulfillmentItem\Database\Factories\PrescriptionFulfillmentItemFactory;

class PrescriptionFulfillmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_fulfillment_id',
        'prescription_item_id',
        'quantity_served',
        'is_substituted',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_substituted' => 'boolean',
        ];
    }

    public function prescriptionFulfillment(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment::class);
    }

    public function prescriptionItem(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescriptionItem\Models\PrescriptionItem::class);
    }

    protected static function newFactory(): PrescriptionFulfillmentItemFactory
    {
        return PrescriptionFulfillmentItemFactory::new();
    }
}
