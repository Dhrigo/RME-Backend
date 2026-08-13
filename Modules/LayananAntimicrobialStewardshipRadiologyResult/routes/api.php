<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Http\Controllers\AntimicrobialStewardshipRadiologyResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-radiology-results', AntimicrobialStewardshipRadiologyResultController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-radiology-results' => 'amr_rad']);
});
