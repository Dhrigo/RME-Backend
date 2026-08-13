<?php

namespace Modules\GeneralOtherServiceTariff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralOtherService\Models\OtherService;
use Modules\GeneralOtherServiceTariff\Database\Factories\OtherServiceTariffFactory;
use Modules\GeneralRoomClass\Models\RoomClass;

class OtherServiceTariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'other_service_id',
        'room_class_id',
        'price',
        'effective_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function otherService(): BelongsTo
    {
        return $this->belongsTo(OtherService::class);
    }

    public function roomClass(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class);
    }

    protected static function newFactory(): OtherServiceTariffFactory
    {
        return OtherServiceTariffFactory::new();
    }
}
