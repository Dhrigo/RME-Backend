<?php

namespace Modules\LayananExaminationResultStatus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananExaminationResultStatus\Database\Factories\ExaminationResultStatusFactory;

class ExaminationResultStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'examination_type',
        'status',
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'verified_by');
    }

    protected static function newFactory(): ExaminationResultStatusFactory
    {
        return ExaminationResultStatusFactory::new();
    }
}
