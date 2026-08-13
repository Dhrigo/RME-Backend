<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananMedicationServiceLimit\Http\Controllers\MedicationServiceLimitController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medication-service-limits', MedicationServiceLimitController::class)->parameters(['medication-service-limits' => 'service_limit']);
});
