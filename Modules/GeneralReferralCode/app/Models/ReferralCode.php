<?php

namespace Modules\GeneralReferralCode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Modules\GeneralReferralCode\Database\Factories\ReferralCodeFactory;

class ReferralCode extends Model
{
    use HasFactory;

    protected $table = 'referral_codes';

    protected $fillable = [
        'code',
        'name',
        'category',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ReferralCodeFactory
    {
        return ReferralCodeFactory::new();
    }
}
