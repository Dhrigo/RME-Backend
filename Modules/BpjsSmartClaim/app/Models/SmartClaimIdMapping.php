<?php

namespace Modules\BpjsSmartClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\BpjsSmartClaim\Database\Factories\SmartClaimIdMappingFactory;

class SmartClaimIdMapping extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'ref_id',
        'ref_type',
        'type_code',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $mapping) {
            $mapping->id ??= (string) Str::uuid();
        });
    }

    protected static function newFactory(): SmartClaimIdMappingFactory
    {
        return SmartClaimIdMappingFactory::new();
    }
}
