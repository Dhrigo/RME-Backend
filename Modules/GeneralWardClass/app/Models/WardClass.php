<?php

namespace Modules\GeneralWardClass\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralWardClass\Database\Factories\WardClassFactory;
// use Modules\GeneralWardClass\Database\Factories\WardClassFactory;

class WardClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): WardClassFactory
    {
        return WardClassFactory::new();
    }
}
