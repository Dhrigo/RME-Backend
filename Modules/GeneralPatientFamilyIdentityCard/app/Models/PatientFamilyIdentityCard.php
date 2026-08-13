<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatientFamilyIdentityCard\Database\Factories\PatientFamilyIdentityCardFactory;
// use Modules\GeneralPatientFamilyIdentityCard\Database\Factories\PatientFamilyIdentityCardFactory;

class PatientFamilyIdentityCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_family_id',
        'identity_type',
        'identity_number',
        'is_active',
    ];

    protected static function newFactory(): PatientFamilyIdentityCardFactory
    {
        return PatientFamilyIdentityCardFactory::new();
    }
}
