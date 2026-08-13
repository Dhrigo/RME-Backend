<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;
use Modules\LayananTreatmentProtocolStepDrug\Database\Factories\TreatmentProtocolStepDrugFactory;

class TreatmentProtocolStepDrug extends Model
{
    use HasFactory;

    protected $fillable = [
        'treatment_protocol_step_id',
        'drug_name',
        'dosage',
        'frequency',
        'route',
    ];

    public function treatmentProtocolStep(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep::class);
    }

    protected static function newFactory(): TreatmentProtocolStepDrugFactory
    {
        return TreatmentProtocolStepDrugFactory::new();
    }
}
