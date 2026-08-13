<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordInhalantAllergenExamination\Http\Controllers\InhalantAllergenExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inhalant-allergen-examinations', InhalantAllergenExaminationController::class)
        ->parameters(['inhalant-allergen-examinations' => 'record']);
});
