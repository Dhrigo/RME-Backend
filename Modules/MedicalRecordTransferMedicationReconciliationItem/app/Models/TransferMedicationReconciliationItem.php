<?php

namespace Modules\MedicalRecordTransferMedicationReconciliationItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Database\Factories\TransferMedicationReconciliationItemFactory;

class TransferMedicationReconciliationItem extends Model
{
    use HasFactory;

    protected $table = 'transfer_medication_reconciliation_items';

    protected $fillable = [
        'reconciliation_id',
        'drug_name',
        'dose',
        'frequency',
        'route',
        'action',
        'reason',
    ];

    public function reconciliation(): BelongsTo
    {
        return $this->belongsTo(TransferMedicationReconciliation::class, 'reconciliation_id');
    }

    protected static function newFactory(): TransferMedicationReconciliationItemFactory
    {
        return TransferMedicationReconciliationItemFactory::new();
    }
}
