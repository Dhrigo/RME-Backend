<?php

namespace Modules\GeneralMedicalPersonnel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralMedicalPersonnel\Database\Factories\MedicalPersonnelFactory;
use Modules\GeneralProfession\Models\Profession;

class MedicalPersonnel extends Model
{
    use HasFactory;

    protected $table = 'medical_personnel';

    protected $fillable = [
        'identity_number',
        'name',
        'personnel_type',
        'profession_id',
        'license_number',
        'phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    protected static function newFactory(): MedicalPersonnelFactory
    {
        return MedicalPersonnelFactory::new();
    }
}
