<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordImmunizationVaccination\Http\Controllers\ImmunizationVaccinationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('immunization-vaccinations', ImmunizationVaccinationController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['immunization-vaccinations' => 'record']);
});
