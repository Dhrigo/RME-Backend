<?php

namespace Modules\GeneralRadiologyWard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralRadiologyWard\Database\Factories\RadiologyWardFactory;
// use Modules\GeneralRadiologyWard\Database\Factories\RadiologyWardFactory;

class RadiologyWard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): RadiologyWardFactory
    {
        return RadiologyWardFactory::new();
    }
}
