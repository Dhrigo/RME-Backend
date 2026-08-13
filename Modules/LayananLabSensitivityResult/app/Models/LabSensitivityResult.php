<?php

namespace Modules\LayananLabSensitivityResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabSensitivityResult\Database\Factories\LabSensitivityResultFactory;

class LabSensitivityResult extends Model
{
    use HasFactory;

    protected $table = 'lab_sensitivity_results';

    public const SENSITIVITY_RESULTS = ['sensitive', 'intermediate', 'resistant'];

    protected $fillable = [
        'lab_order_id',
        'organism',
        'antibiotic_name',
        'sensitivity_result',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    protected static function newFactory(): LabSensitivityResultFactory
    {
        return LabSensitivityResultFactory::new();
    }
}
