<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Http\Controllers\AdmissionMedicationReconciliationItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admission-med-reconciliation-items', AdmissionMedicationReconciliationItemController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['admission-med-reconciliation-items' => 'record']);
});
