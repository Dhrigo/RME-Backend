<?php

namespace Modules\PendaftaranFunction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PendaftaranFunction\Database\Factories\RegistrationFunctionFactory;

/**
 * Reference list of front-desk registration duties/roles (e.g. loket pendaftaran,
 * verifikasi jaminan, admisi) that a Pendaftaran officer can be assigned.
 */
class RegistrationFunction extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): RegistrationFunctionFactory
    {
        return RegistrationFunctionFactory::new();
    }
}
