<?php

namespace Modules\LayananLabPcrResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabPcrResult\Database\Factories\LabPcrResultFactory;

class LabPcrResult extends Model
{
    use HasFactory;

    protected $table = 'lab_pcr_results';

    public const RESULTS = ['detected', 'not_detected', 'inconclusive'];

    protected $fillable = [
        'lab_order_id',
        'target_gene',
        'result',
        'ct_value',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'ct_value' => 'decimal:2',
            'examined_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    protected static function newFactory(): LabPcrResultFactory
    {
        return LabPcrResultFactory::new();
    }
}
