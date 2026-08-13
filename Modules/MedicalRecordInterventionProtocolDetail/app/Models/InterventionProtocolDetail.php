<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;
use Modules\MedicalRecordInterventionProtocolDetail\Database\Factories\InterventionProtocolDetailFactory;

class InterventionProtocolDetail extends Model
{
    use HasFactory;

    protected $table = 'intervention_protocol_details';

    protected $fillable = [
        'protocol_id',
        'performed_by',
        'step_number',
        'step_description',
        'result_notes',
        'performed_at',
    ];

    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function protocol(): BelongsTo
    {
        return $this->belongsTo(InterventionProtocol::class, 'protocol_id');
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'performed_by');
    }

    protected static function newFactory(): InterventionProtocolDetailFactory
    {
        return InterventionProtocolDetailFactory::new();
    }
}
