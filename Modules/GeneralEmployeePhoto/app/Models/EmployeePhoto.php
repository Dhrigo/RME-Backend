<?php

namespace Modules\GeneralEmployeePhoto\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralEmployeePhoto\Database\Factories\EmployeePhotoFactory;
// use Modules\GeneralEmployeePhoto\Database\Factories\EmployeePhotoFactory;

class EmployeePhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): EmployeePhotoFactory
    {
        return EmployeePhotoFactory::new();
    }
}
