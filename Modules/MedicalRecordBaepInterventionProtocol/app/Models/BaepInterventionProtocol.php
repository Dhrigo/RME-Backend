<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordBaepInterventionProtocol\Database\Factories\BaepInterventionProtocolFactory;

class BaepInterventionProtocol extends Model
{
    use HasFactory;

    protected $table = 'baep_intervention_protocols';

    protected $fillable = [
        'visit_id',
        'performed_by',
        'created_by',
        'indication',
        'stimulation_ear',
        'click_rate_hz',
        'stimulus_intensity_db',
        'wave_i_latency_ms',
        'wave_iii_latency_ms',
        'wave_v_latency_ms',
        'interpretation',
        'status',
        'performed_at',
    ];

    protected function casts(): array
    {
        return [
            'click_rate_hz' => 'decimal:2',
            'wave_i_latency_ms' => 'decimal:2',
            'wave_iii_latency_ms' => 'decimal:2',
            'wave_v_latency_ms' => 'decimal:2',
            'performed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'performed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): BaepInterventionProtocolFactory
    {
        return BaepInterventionProtocolFactory::new();
    }
}
