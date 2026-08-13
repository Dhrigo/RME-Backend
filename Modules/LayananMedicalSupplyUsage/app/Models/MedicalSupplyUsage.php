<?php

namespace Modules\LayananMedicalSupplyUsage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananMedicalSupplyUsage\Database\Factories\MedicalSupplyUsageFactory;

class MedicalSupplyUsage extends Model
{
    use HasFactory;

    protected $table = 'medical_supply_usages';

    public const STATUSS = ['draft', 'posted'];

    protected $fillable = [
        'visit_id',
        'recorded_by',
        'used_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'used_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    protected static function newFactory(): MedicalSupplyUsageFactory
    {
        return MedicalSupplyUsageFactory::new();
    }
}
