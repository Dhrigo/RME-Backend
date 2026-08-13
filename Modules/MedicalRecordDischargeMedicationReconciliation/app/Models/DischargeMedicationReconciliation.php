<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDischargeMedicationReconciliation\Database\Factories\DischargeMedicationReconciliationFactory;

class DischargeMedicationReconciliation extends Model
{
    use HasFactory;

    protected $table = 'discharge_medication_reconciliations';

    protected $fillable = [
        'visit_id',
        'reconciled_by',
        'created_by',
        'source_of_medication_list',
        'notes',
        'status',
        'reconciled_at',
    ];

    protected function casts(): array
    {
        return [
            'reconciled_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function reconciledBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reconciled_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): DischargeMedicationReconciliationFactory
    {
        return DischargeMedicationReconciliationFactory::new();
    }
}
