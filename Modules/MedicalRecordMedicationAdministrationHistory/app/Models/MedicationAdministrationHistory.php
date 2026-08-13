<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMedicationAdministrationHistory\Database\Factories\MedicationAdministrationHistoryFactory;

class MedicationAdministrationHistory extends Model
{
    use HasFactory;

    protected $table = 'medication_administration_histories';

    protected $fillable = [
        'visit_id',
        'administered_by',
        'created_by',
        'drug_name',
        'dose',
        'route',
        'administered_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'administered_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function administeredBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'administered_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): MedicationAdministrationHistoryFactory
    {
        return MedicationAdministrationHistoryFactory::new();
    }
}
