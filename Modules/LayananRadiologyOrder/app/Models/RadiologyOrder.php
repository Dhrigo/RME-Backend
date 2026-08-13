<?php

namespace Modules\LayananRadiologyOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananRadiologyOrder\Database\Factories\RadiologyOrderFactory;

class RadiologyOrder extends Model
{
    use HasFactory;

    protected $table = 'radiology_orders';

    public const STATUSS = ['pending', 'in_progress', 'completed', 'cancelled'];

    protected $fillable = [
        'visit_id',
        'patient_id',
        'ordering_doctor_id',
        'ordered_at',
        'clinical_notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'datetime',
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

    public function orderingDoctor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordering_doctor_id');
    }

    protected static function newFactory(): RadiologyOrderFactory
    {
        return RadiologyOrderFactory::new();
    }
}
