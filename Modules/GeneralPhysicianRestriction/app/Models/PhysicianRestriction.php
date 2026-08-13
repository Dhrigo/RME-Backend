<?php

namespace Modules\GeneralPhysicianRestriction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPhysicianRestriction\Database\Factories\PhysicianRestrictionFactory;

class PhysicianRestriction extends Model
{
    use HasFactory;

    public const AUTHORIZATION_LEVELS = ['general', 'spesialis', 'tim_ppra'];

    protected $fillable = [
        'doctor_id',
        'restricted_antibiotic_name',
        'authorization_level',
        'is_authorized_prescriber',
        'notes',
    ];

    protected function casts(): array
    {
        return ['is_authorized_prescriber' => 'boolean'];
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    protected static function newFactory(): PhysicianRestrictionFactory
    {
        return PhysicianRestrictionFactory::new();
    }
}
