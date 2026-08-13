<?php

namespace Modules\LayananCriticalLabValue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananCriticalLabValue\Database\Factories\CriticalLabValueFactory;

class CriticalLabValue extends Model
{
    use HasFactory;

    protected $table = 'critical_lab_values';

    protected $fillable = [
        'lab_order_id',
        'parameter_name',
        'critical_value',
        'notified_to',
        'notified_at',
        'acknowledged',
    ];

    protected function casts(): array
    {
        return [
            'notified_at' => 'datetime',
            'acknowledged' => 'boolean',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    protected static function newFactory(): CriticalLabValueFactory
    {
        return CriticalLabValueFactory::new();
    }
}
