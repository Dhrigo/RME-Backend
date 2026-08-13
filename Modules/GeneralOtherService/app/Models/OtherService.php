<?php

namespace Modules\GeneralOtherService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralOtherService\Database\Factories\OtherServiceFactory;

class OtherService extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'unit', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): OtherServiceFactory
    {
        return OtherServiceFactory::new();
    }
}
