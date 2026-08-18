<?php

namespace Modules\GeneralPatientFamily\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatientFamily\Database\Factories\PatientFamilyFactory;

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
        'birth_date',
        'gender_id',
        'education_id',
        'occupation_id',
        'address',
        'rt',
        'rw',
        'postal_code',
        'village_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): PatientFamilyFactory
    {
        return PatientFamilyFactory::new();
    }
}
