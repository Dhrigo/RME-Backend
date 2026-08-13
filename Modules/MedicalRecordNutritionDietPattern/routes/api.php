<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNutritionDietPattern\Http\Controllers\NutritionDietPatternController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nutrition-diet-patterns', NutritionDietPatternController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['nutrition-diet-patterns' => 'record']);
});
