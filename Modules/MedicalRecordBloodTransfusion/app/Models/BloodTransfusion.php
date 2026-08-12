<?php

namespace Modules\MedicalRecordBloodTransfusion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\KemkesBloodType\Models\BloodType;
use Modules\MedicalRecordBloodTransfusion\Database\Factories\BloodTransfusionFactory;
use Modules\PendaftaranVisit\Models\Visit;

class BloodTransfusion extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'blood_type_id',
        'volume_ml',
        'started_at',
        'ended_at',
        'administered_by',
        'reaction_notes',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }

    public function administeredBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'administered_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): BloodTransfusionFactory
    {
        return BloodTransfusionFactory::new();
    }
}
