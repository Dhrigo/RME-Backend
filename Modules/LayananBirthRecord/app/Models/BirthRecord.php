<?php

namespace Modules\LayananBirthRecord\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralGender\Models\Gender;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananBirthRecord\Database\Factories\BirthRecordFactory;

class BirthRecord extends Model
{
    use HasFactory;

    protected $table = 'birth_records';

    public const DELIVERY_METHODS = ['normal', 'cesarean', 'assisted'];

    protected $fillable = [
        'visit_id',
        'mother_patient_id',
        'baby_name',
        'gender_id',
        'birth_date',
        'birth_weight_grams',
        'birth_length_cm',
        'delivery_method',
        'attending_doctor_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
            'birth_length_cm' => 'decimal:1',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function motherPatient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'mother_patient_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function attendingDoctor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'attending_doctor_id');
    }

    protected static function newFactory(): BirthRecordFactory
    {
        return BirthRecordFactory::new();
    }
}
