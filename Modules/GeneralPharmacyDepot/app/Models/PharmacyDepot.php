<?php

namespace Modules\GeneralPharmacyDepot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralWard\Models\Ward;
use Modules\GeneralPharmacyDepot\Database\Factories\PharmacyDepotFactory;

class PharmacyDepot extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_depots';

    protected $fillable = [
        'code',
        'name',
        'ward_id',
        'phone',
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

    protected static function newFactory(): PharmacyDepotFactory
    {
        return PharmacyDepotFactory::new();
    }
}
