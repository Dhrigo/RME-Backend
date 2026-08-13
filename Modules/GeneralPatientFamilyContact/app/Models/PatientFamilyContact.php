<?php

namespace Modules\GeneralPatientFamilyContact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatientFamilyContact\Database\Factories\PatientFamilyContactFactory;
// use Modules\GeneralPatientFamilyContact\Database\Factories\PatientFamilyContactFactory;

class PatientFamilyContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_family_id',
        'contact_type',
        'contact_value',
        'is_active',
    ];

    protected static function newFactory(): PatientFamilyContactFactory
    {
        return PatientFamilyContactFactory::new();
    }
}
