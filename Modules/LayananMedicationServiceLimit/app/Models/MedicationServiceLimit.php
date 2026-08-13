<?php

namespace Modules\LayananMedicationServiceLimit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use Modules\LayananMedicationServiceLimit\Database\Factories\MedicationServiceLimitFactory;

class MedicationServiceLimit extends Model
{
    use HasFactory;

    protected $table = 'medication_service_limits';

    protected $fillable = [
        'item_id',
        'guarantor_type',
        'max_quantity_per_month',
        'max_days_supply',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): MedicationServiceLimitFactory
    {
        return MedicationServiceLimitFactory::new();
    }
}
