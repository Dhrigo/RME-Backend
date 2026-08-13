<?php

namespace Modules\PendaftaranCoManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranCoManagement\Database\Factories\CoManagementFactory;
use Modules\PendaftaranVisit\Models\Visit;

class CoManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'employee_id',
        'started_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory(): CoManagementFactory
    {
        return CoManagementFactory::new();
    }
}
