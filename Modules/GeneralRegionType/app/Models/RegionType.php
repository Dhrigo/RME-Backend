<?php

namespace Modules\GeneralRegionType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralRegionType\Database\Factories\RegionTypeFactory;

class RegionType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'digit_count', 'delimiter', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): RegionTypeFactory
    {
        return RegionTypeFactory::new();
    }
}
