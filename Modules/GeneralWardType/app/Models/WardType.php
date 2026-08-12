<?php

namespace Modules\GeneralWardType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralWardType\Database\Factories\WardTypeFactory;

class WardType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): WardTypeFactory
    {
        return WardTypeFactory::new();
    }
}
