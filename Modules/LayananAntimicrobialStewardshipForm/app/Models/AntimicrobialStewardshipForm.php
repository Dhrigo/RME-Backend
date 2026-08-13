<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananAntimicrobialStewardshipForm\Database\Factories\AntimicrobialStewardshipFormFactory;

class AntimicrobialStewardshipForm extends Model
{
    use HasFactory;

    protected $table = 'antimicrobial_stewardship_forms';

    public const STATUSS = ['draft', 'submitted', 'approved', 'rejected'];

    protected $fillable = [
        'visit_id',
        'patient_id',
        'requesting_doctor_id',
        'antibiotic_restriction_id',
        'indication',
        'status',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function requestingDoctor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'requesting_doctor_id');
    }

    public function antibioticRestriction(): BelongsTo
    {
        return $this->belongsTo(AntibioticRestriction::class, 'antibiotic_restriction_id');
    }

    protected static function newFactory(): AntimicrobialStewardshipFormFactory
    {
        return AntimicrobialStewardshipFormFactory::new();
    }
}
