<?php

namespace Modules\PembayaranDeposit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Database\Factories\DepositFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_number',
        'visit_id',
        'amount',
        'paid_at',
        'received_by',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Format: DEP-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateDepositNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('deposit_number', 'like', "DEP-{$year}-%")->count();

        return sprintf('DEP-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): DepositFactory
    {
        return DepositFactory::new();
    }
}
