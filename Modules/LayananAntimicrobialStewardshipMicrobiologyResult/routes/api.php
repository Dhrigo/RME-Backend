<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Controllers\AntimicrobialStewardshipMicrobiologyResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-microbiology-results', AntimicrobialStewardshipMicrobiologyResultController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-microbiology-results' => 'amr_micro']);
});
