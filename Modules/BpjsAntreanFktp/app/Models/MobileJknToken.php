<?php

namespace Modules\BpjsAntreanFktp\Models;

use Illuminate\Database\Eloquent\Model;

class MobileJknToken extends Model
{
    protected $table = 'antrean_fktp_mobile_jkn_tokens';

    protected $fillable = [
        'username',
        'token',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
