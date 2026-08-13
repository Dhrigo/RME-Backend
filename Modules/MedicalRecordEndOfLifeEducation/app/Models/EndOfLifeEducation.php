<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEndOfLifeEducation\Database\Factories\EndOfLifeEducationFactory;

class EndOfLifeEducation extends Model
{
    use HasFactory;

    protected $table = 'end_of_life_educations';

    protected $fillable = [
        'visit_id',
        'topic',
        'participants',
        'decision_summary',
        'educator_id',
        'educated_at',
    ];

    protected function casts(): array
    {
        return [
            'educated_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function educator(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class);
    }

    protected static function newFactory(): EndOfLifeEducationFactory
    {
        return EndOfLifeEducationFactory::new();
    }
}
