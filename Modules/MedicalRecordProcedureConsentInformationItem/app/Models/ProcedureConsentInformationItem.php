<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation;
use Modules\MedicalRecordProcedureConsentInformationItem\Database\Factories\ProcedureConsentInformationItemFactory;

class ProcedureConsentInformationItem extends Model
{
    use HasFactory;

    protected $table = 'procedure_consent_information_items';

    protected $fillable = [
        'information_id',
        'item_name',
        'is_explained',
        'is_understood',
    ];

    protected function casts(): array
    {
        return [
            'is_explained' => 'boolean',
            'is_understood' => 'boolean',
        ];
    }

    public function information(): BelongsTo
    {
        return $this->belongsTo(ProcedureConsentInformation::class, 'information_id');
    }

    protected static function newFactory(): ProcedureConsentInformationItemFactory
    {
        return ProcedureConsentInformationItemFactory::new();
    }
}
