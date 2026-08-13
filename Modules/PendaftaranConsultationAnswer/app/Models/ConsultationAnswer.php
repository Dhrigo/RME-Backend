<?php

namespace Modules\PendaftaranConsultationAnswer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranConsultationAnswer\Database\Factories\ConsultationAnswerFactory;

class ConsultationAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'answered_by',
        'answered_at',
        'answer',
    ];

    protected function casts(): array
    {
        return [
            'answered_at' => 'datetime',
        ];
    }

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    public function answeredBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'answered_by');
    }

    protected static function newFactory(): ConsultationAnswerFactory
    {
        return ConsultationAnswerFactory::new();
    }
}
