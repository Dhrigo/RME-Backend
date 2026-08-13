<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliationItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Models\AdmissionMedicationReconciliation;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Database\Factories\AdmissionMedicationReconciliationItemFactory;

class AdmissionMedicationReconciliationItem extends Model
{
    use HasFactory;

    protected $table = 'admission_medication_reconciliation_items';

    protected $fillable = [
        'reconciliation_id',
        'drug_name',
        'dose',
        'frequency',
        'route',
        'action',
        'reason',
        'last_taken_at',
    ];

    protected function casts(): array
    {
        return [
            'last_taken_at' => 'datetime',
        ];
    }

    public function reconciliation(): BelongsTo
    {
        return $this->belongsTo(AdmissionMedicationReconciliation::class, 'reconciliation_id');
    }

    protected static function newFactory(): AdmissionMedicationReconciliationItemFactory
    {
        return AdmissionMedicationReconciliationItemFactory::new();
    }
}
