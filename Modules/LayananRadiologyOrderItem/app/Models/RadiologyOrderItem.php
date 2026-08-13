<?php

namespace Modules\LayananRadiologyOrderItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyOrderItem\Database\Factories\RadiologyOrderItemFactory;

class RadiologyOrderItem extends Model
{
    use HasFactory;

    protected $table = 'radiology_order_items';

    protected $fillable = [
        'radiology_order_id',
        'examination_name',
        'body_part',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function radiologyOrder(): BelongsTo
    {
        return $this->belongsTo(RadiologyOrder::class, 'radiology_order_id');
    }

    protected static function newFactory(): RadiologyOrderItemFactory
    {
        return RadiologyOrderItemFactory::new();
    }
}
