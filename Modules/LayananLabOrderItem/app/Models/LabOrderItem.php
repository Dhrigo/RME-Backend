<?php

namespace Modules\LayananLabOrderItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\InventoryItem\Models\Item;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabOrderItem\Database\Factories\LabOrderItemFactory;

class LabOrderItem extends Model
{
    use HasFactory;

    protected $table = 'lab_order_items';

    protected $fillable = [
        'lab_order_id',
        'examination_name',
        'item_id',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected static function newFactory(): LabOrderItemFactory
    {
        return LabOrderItemFactory::new();
    }
}
