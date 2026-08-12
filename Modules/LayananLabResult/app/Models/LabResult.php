<?php

namespace Modules\LayananLabResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabResult\Database\Factories\LabResultFactory;

class LabResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_order_id',
        'test_name',
        'result_value',
        'normal_range',
        'unit',
        'is_abnormal',
        'notes',
        'recorded_at',
        'recorded_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_abnormal' => 'boolean',
            'recorded_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    protected static function newFactory(): LabResultFactory
    {
        return LabResultFactory::new();
    }
}
