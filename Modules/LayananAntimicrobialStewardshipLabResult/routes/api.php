<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipLabResult\Http\Controllers\AntimicrobialStewardshipLabResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-lab-results', AntimicrobialStewardshipLabResultController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-lab-results' => 'amr_lab']);
});
