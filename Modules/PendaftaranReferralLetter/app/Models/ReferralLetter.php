<?php

namespace Modules\PendaftaranReferralLetter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranReferralLetter\Database\Factories\ReferralLetterFactory;
use Modules\PendaftaranVisit\Models\Visit;

class ReferralLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'from_department_id',
        'to_department_id',
        'issued_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function fromDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'from_department_id');
    }

    public function toDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'to_department_id');
    }

    protected static function newFactory(): ReferralLetterFactory
    {
        return ReferralLetterFactory::new();
    }
}
