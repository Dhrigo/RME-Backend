<?php

namespace Modules\PendaftaranConsultation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranConsultation\Database\Factories\ConsultationFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'requesting_department_id',
        'consulted_department_id',
        'requested_at',
        'question',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function requestingDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'requesting_department_id');
    }

    public function consultedDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'consulted_department_id');
    }

    protected static function newFactory(): ConsultationFactory
    {
        return ConsultationFactory::new();
    }
}
