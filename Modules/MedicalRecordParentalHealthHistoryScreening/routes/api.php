<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordParentalHealthHistoryScreening\Http\Controllers\ParentalHealthHistoryScreeningController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('parental-health-history-screenings', ParentalHealthHistoryScreeningController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['parental-health-history-screenings' => 'record']);
});
