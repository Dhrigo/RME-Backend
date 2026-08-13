<?php

namespace Modules\MedicalRecordImplementation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImplementation\Database\Factories\ImplementationFactory;

class Implementation extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'order_reference',
        'description',
        'performed_by',
        'performed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'performed_by');
    }

    protected static function newFactory(): ImplementationFactory
    {
        return ImplementationFactory::new();
    }
}
