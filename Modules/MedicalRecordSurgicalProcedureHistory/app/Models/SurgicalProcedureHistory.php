<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordSurgicalProcedureHistory\Database\Factories\SurgicalProcedureHistoryFactory;

class SurgicalProcedureHistory extends Model
{
    use HasFactory;

    protected $table = 'surgical_procedure_histories';

    protected $fillable = [
        'visit_id',
        'created_by',
        'procedure_name',
        'procedure_date',
        'facility_name',
        'surgeon_name',
        'complications',
    ];

    protected function casts(): array
    {
        return [
            'procedure_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): SurgicalProcedureHistoryFactory
    {
        return SurgicalProcedureHistoryFactory::new();
    }
}
