<?php

namespace Modules\GeneralPatient\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravolt\Indonesia\Models\Village;
use Modules\Auth\Models\User;
use Modules\GeneralCountry\Models\Country;
use Modules\GeneralEducation\Models\Education;
use Modules\GeneralEthnicity\Models\Ethnicity;
use Modules\GeneralGender\Models\Gender;
use Modules\GeneralLanguage\Models\Language;
use Modules\GeneralMaritalStatus\Models\MaritalStatus;
use Modules\GeneralOccupation\Models\Occupation;
use Modules\GeneralPatient\Database\Factories\PatientFactory;
use Modules\GeneralReligion\Models\Religion;
use Modules\KemkesBloodType\Models\BloodType;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_number',
        'name',
        'nickname',
        'title_prefix',
        'title_suffix',
        'birth_place',
        'birth_date',
        'gender_id',
        'religion_id',
        'address',
        'rt',
        'rw',
        'postal_code',
        'village_id',
        'education_id',
        'occupation_id',
        'marital_status_id',
        'blood_type_id',
        'nationality_id',
        'ethnicity_id',
        'language_id',
        'is_unidentified',
        'registered_by',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_unidentified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Format: RM-{year}-{6-digit sequential per year}. Not concurrency-safe under
     * simultaneous registrations (read-then-write) - acceptable for now, revisit
     * with a DB sequence/lock once real registration volume is a concern.
     */
    public static function generateMedicalRecordNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('medical_record_number', 'like', "RM-{$year}-%")->count();

        return sprintf('RM-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): PatientFactory
    {
        return PatientFactory::new();
    }
}
