<?php

namespace Modules\LayananMedicalProcedure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralService\Models\Service;
use Modules\LayananMedicalProcedure\Database\Factories\MedicalProcedureFactory;
use Modules\PendaftaranVisit\Models\Visit;

class MedicalProcedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'service_id',
        'performed_at',
        'performed_by',
        'notes',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'performed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): MedicalProcedureFactory
    {
        return MedicalProcedureFactory::new();
    }
}
