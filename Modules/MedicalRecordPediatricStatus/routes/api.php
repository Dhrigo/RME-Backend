<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPediatricStatus\Http\Controllers\PediatricStatusController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pediatric-statuses', PediatricStatusController::class)->parameters([
        'pediatric-statuses' => 'status',
    ]);
});
