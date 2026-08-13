<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPatientNutritionProblem\Database\Factories\PatientNutritionProblemFactory;

class PatientNutritionProblem extends Model
{
    use HasFactory;

    protected $table = 'patient_nutrition_problems';

    protected $fillable = [
        'visit_id',
        'identified_by',
        'created_by',
        'problem_category',
        'problem_description',
        'intervention_plan',
        'status',
        'identified_at',
    ];

    protected function casts(): array
    {
        return [
            'identified_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function identifiedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'identified_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): PatientNutritionProblemFactory
    {
        return PatientNutritionProblemFactory::new();
    }
}
