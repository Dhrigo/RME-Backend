<?php

namespace Modules\GeneralServiceTariff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralService\Models\Service;
use Modules\GeneralServiceTariff\Database\Factories\ServiceTariffFactory;

class ServiceTariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'room_class_id',
        'price',
        'effective_date',
        'decree_number',
        'decree_date',
        'created_by',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'effective_date' => 'date',
            'decree_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): ServiceTariffFactory
    {
        return ServiceTariffFactory::new();
    }
}
