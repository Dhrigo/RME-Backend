<?php

namespace Modules\MedicalRecordEmergencyEducation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEmergencyEducation\Database\Factories\EmergencyEducationFactory;

class EmergencyEducation extends Model
{
    use HasFactory;

    protected $table = 'emergency_educations';

    protected $fillable = [
        'visit_id',
        'topic',
        'method',
        'understanding_level',
        'educator_id',
        'educated_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'educated_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function educator(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }

    protected static function newFactory(): EmergencyEducationFactory
    {
        return EmergencyEducationFactory::new();
    }
}
