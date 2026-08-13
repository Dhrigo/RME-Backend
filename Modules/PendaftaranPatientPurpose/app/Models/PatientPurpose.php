<?php

namespace Modules\PendaftaranPatientPurpose\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PendaftaranPatientPurpose\Database\Factories\PatientPurposeFactory;

class PatientPurpose extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): PatientPurposeFactory
    {
        return PatientPurposeFactory::new();
    }
}