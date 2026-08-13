<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabPcrResult\Http\Controllers\LabPcrResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-pcr-results', LabPcrResultController::class)->only(['index', 'store', 'show'])->parameters(['lab-pcr-results' => 'pcr_result']);
});
