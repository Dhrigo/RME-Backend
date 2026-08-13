<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabMicroscopicResult\Http\Controllers\LabMicroscopicResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-microscopic-results', LabMicroscopicResultController::class)->only(['index', 'store', 'show'])->parameters(['lab-microscopic-results' => 'microscopic_result']);
});
