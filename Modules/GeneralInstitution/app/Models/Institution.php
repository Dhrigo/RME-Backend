<?php

namespace Modules\GeneralInstitution\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralInstitution\Database\Factories\InstitutionFactory;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = ['ppk_id', 'email', 'website'];

    protected static function newFactory(): InstitutionFactory
    {
        return InstitutionFactory::new();
    }
}
