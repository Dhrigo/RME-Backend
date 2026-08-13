<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMedicationAdministrationHistory\Http\Controllers\MedicationAdministrationHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medication-admin-histories', MedicationAdministrationHistoryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['medication-admin-histories' => 'record']);
});
