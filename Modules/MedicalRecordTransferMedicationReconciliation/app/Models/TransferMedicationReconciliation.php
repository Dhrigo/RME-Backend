<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordTransferMedicationReconciliation\Database\Factories\TransferMedicationReconciliationFactory;

class TransferMedicationReconciliation extends Model
{
    use HasFactory;

    protected $table = 'transfer_medication_reconciliations';

    protected $fillable = [
        'visit_id',
        'reconciled_by',
        'created_by',
        'transferred_to_ward_id',
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

    public function transferredToWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'transferred_to_ward_id');
    }

    protected static function newFactory(): TransferMedicationReconciliationFactory
    {
        return TransferMedicationReconciliationFactory::new();
    }
}
