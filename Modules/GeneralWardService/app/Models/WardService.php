<?php

namespace Modules\GeneralWardService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralService\Models\Service;
use \Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardService\Database\Factories\WardServiceFactory;

class WardService extends Model
{
    use HasFactory;

    protected $table = 'ward_services';

    protected $fillable = [
        'ward_id',
        'service_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    protected static function newFactory(): WardServiceFactory
    {
        return WardServiceFactory::new();
    }
}
