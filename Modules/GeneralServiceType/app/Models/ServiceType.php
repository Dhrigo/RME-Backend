<?php

namespace Modules\GeneralServiceType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralServiceType\Database\Factories\ServiceTypeFactory;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ServiceTypeFactory
    {
        return ServiceTypeFactory::new();
    }
}
