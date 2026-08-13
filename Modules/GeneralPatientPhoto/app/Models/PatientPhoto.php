<?php

namespace Modules\GeneralPatientPhoto\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatientPhoto\Database\Factories\PatientPhotoFactory;
// use Modules\GeneralPatientPhoto\Database\Factories\PatientPhotoFactory;

class PatientPhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'is_active'];

    protected static function newFactory(): PatientPhotoFactory
    {
        return PatientPhotoFactory::new();
    }
}
