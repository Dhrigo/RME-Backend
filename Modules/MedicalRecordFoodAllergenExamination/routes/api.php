<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordFoodAllergenExamination\Http\Controllers\FoodAllergenExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('food-allergen-examinations', FoodAllergenExaminationController::class)
        ->parameters(['food-allergen-examinations' => 'record']);
});
