<?php

namespace Modules\GeneralLaboratoryWard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralLaboratoryWard\Database\Factories\LaboratoryWardFactory;
// use Modules\GeneralLaboratoryWard\Database\Factories\LaboratoryWardFactory;

class LaboratoryWard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): LaboratoryWardFactory
    {
        return LaboratoryWardFactory::new();
    }
}
