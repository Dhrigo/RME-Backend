<?php

namespace Modules\GeneralPatientFamily\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatientFamily\Database\Factories\PatientFamilyFactory;
// use Modules\GeneralPatientFamily\Database\Factories\PatientFamilyFactory;

class PatientFamily extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_id',
        'name',
        'relationship',
        'is_active',
    ];

    protected static function newFactory(): PatientFamilyFactory
    {
        return PatientFamilyFactory::new();
    }
}
