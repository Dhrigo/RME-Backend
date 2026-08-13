<?php

namespace Modules\GeneralPpk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPpk\Database\Factories\PpkFactory;

class Ppk extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'bpjs_code', 'type', 'ownership', 'jpk', 'name', 'class', 'address',
        'rt', 'rw', 'postal_code', 'phone', 'fax', 'region_code', 'region_name',
        'started_at', 'ended_at', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): PpkFactory
    {
        return PpkFactory::new();
    }
}
