<?php

namespace Modules\GeneralOperatingWard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralOperatingWard\Database\Factories\OperatingWardFactory;
// use Modules\GeneralOperatingWard\Database\Factories\OperatingWardFactory;

class OperatingWard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): OperatingWardFactory
    {
        return OperatingWardFactory::new();
    }
}
