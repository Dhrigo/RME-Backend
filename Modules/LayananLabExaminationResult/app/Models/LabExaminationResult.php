<?php

namespace Modules\LayananLabExaminationResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabExaminationResult\Database\Factories\LabExaminationResultFactory;

class LabExaminationResult extends Model
{
    use HasFactory;

    protected $table = 'lab_examination_results';

    protected $fillable = [
        'lab_order_id',
        'parameter_name',
        'result_value',
        'unit',
        'reference_range',
        'is_abnormal',
        'examined_at',
    ];

    protected function casts(): array
    {
        return [
            'is_abnormal' => 'boolean',
            'examined_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    protected static function newFactory(): LabExaminationResultFactory
    {
        return LabExaminationResultFactory::new();
    }
}
