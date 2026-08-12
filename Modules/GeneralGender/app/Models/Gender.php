<?php

namespace Modules\GeneralGender\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralGender\Database\Factories\GenderFactory;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): GenderFactory
    {
        return GenderFactory::new();
    }
}
