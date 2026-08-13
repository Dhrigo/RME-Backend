<?php

namespace Modules\LayananBloodRequestItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\LayananBloodRequestItem\Database\Factories\BloodRequestItemFactory;

class BloodRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_transfusion_id',
        'blood_component',
        'blood_type',
        'bag_quantity',
        'cross_match_result',
        'status',
        'notes',
    ];

    public function bloodTransfusion(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion::class);
    }

    protected static function newFactory(): BloodRequestItemFactory
    {
        return BloodRequestItemFactory::new();
    }
}
