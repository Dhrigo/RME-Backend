<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliationItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Database\Factories\DischargeMedicationReconciliationItemFactory;

class DischargeMedicationReconciliationItem extends Model
{
    use HasFactory;

    protected $table = 'discharge_medication_reconciliation_items';

    protected $fillable = [
        'reconciliation_id',
        'drug_name',
        'dose',
        'frequency',
        'route',
        'action',
        'reason',
        'patient_education_given',
    ];

    protected function casts(): array
    {
        return [
            'patient_education_given' => 'boolean',
        ];
    }

    public function reconciliation(): BelongsTo
    {
        return $this->belongsTo(DischargeMedicationReconciliation::class, 'reconciliation_id');
    }

    protected static function newFactory(): DischargeMedicationReconciliationItemFactory
    {
        return DischargeMedicationReconciliationItemFactory::new();
    }
}
