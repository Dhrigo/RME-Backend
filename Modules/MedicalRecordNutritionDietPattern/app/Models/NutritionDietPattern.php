<?php

namespace Modules\MedicalRecordNutritionDietPattern\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNutritionDietPattern\Database\Factories\NutritionDietPatternFactory;

class NutritionDietPattern extends Model
{
    use HasFactory;

    protected $table = 'nutrition_diet_patterns';

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'diet_type',
        'appetite',
        'meal_frequency_per_day',
        'food_allergies',
        'special_diet_notes',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): NutritionDietPatternFactory
    {
        return NutritionDietPatternFactory::new();
    }
}
