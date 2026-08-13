<?php

namespace Modules\MedicalRecordFluidFinalBalance\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFluidFinalBalance\Database\Factories\FluidFinalBalanceFactory;

class FluidFinalBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'period_date',
        'total_intake_ml',
        'total_output_ml',
        'balance_ml',
        'recorded_by',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'period_date' => 'date',
            'total_intake_ml' => 'decimal:2',
            'total_output_ml' => 'decimal:2',
            'balance_ml' => 'decimal:2',
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): FluidFinalBalanceFactory
    {
        return FluidFinalBalanceFactory::new();
    }
}
