<?php

namespace Modules\PenjaminRSClaimDriver\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimDriver extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\PenjaminRSClaimDriver\Database\Factories\ClaimDriverFactory::new();
    }
}
