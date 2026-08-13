<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPatientNutritionProblem\Http\Controllers\PatientNutritionProblemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-nutrition-problems', PatientNutritionProblemController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['patient-nutrition-problems' => 'record']);
});
