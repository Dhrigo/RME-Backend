<?php

namespace Modules\GeneralPharmacyWard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPharmacyWard\Database\Factories\PharmacyWardFactory;
// use Modules\GeneralPharmacyWard\Database\Factories\PharmacyWardFactory;

class PharmacyWard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): PharmacyWardFactory
    {
        return PharmacyWardFactory::new();
    }
}
