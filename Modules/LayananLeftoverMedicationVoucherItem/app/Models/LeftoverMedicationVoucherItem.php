<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use \Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;
use Modules\LayananLeftoverMedicationVoucherItem\Database\Factories\LeftoverMedicationVoucherItemFactory;

class LeftoverMedicationVoucherItem extends Model
{
    use HasFactory;

    protected $table = 'leftover_medication_voucher_items';

    protected $fillable = [
        'leftover_medication_voucher_id',
        'item_id',
        'quantity',
        'unit',
    ];

    public function leftoverMedicationVoucher(): BelongsTo
    {
        return $this->belongsTo(LeftoverMedicationVoucher::class, 'leftover_medication_voucher_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): LeftoverMedicationVoucherItemFactory
    {
        return LeftoverMedicationVoucherItemFactory::new();
    }
}
