<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordFoodAllergenExamination\Database\Factories\FoodAllergenExaminationFactory;

class FoodAllergenExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'food_allergen_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'food_item',
        'reaction_grade',
        'wheal_diameter_mm',
        'symptoms_observed',
        'interpretation',
        'examined_at',
    ];

    protected $casts = [
        'wheal_diameter_mm' => 'float',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): FoodAllergenExaminationFactory
    {
        return FoodAllergenExaminationFactory::new();
    }
}
