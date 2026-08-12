<?php

namespace Modules\LayananLabOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabOrder\Database\Factories\LabOrderFactory;
use Modules\LayananLabResult\Models\LabResult;
use Modules\PendaftaranVisit\Models\Visit;

class LabOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'visit_id',
        'ordered_by',
        'ordered_at',
        'destination',
        'is_emergency',
        'reason',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'datetime',
            'is_emergency' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function orderedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordered_by');
    }

    public function results(): HasMany
    {
        return $this->hasMany(LabResult::class);
    }

    /**
     * Format: LAB-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateOrderNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('order_number', 'like', "LAB-{$year}-%")->count();

        return sprintf('LAB-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): LabOrderFactory
    {
        return LabOrderFactory::new();
    }
}
