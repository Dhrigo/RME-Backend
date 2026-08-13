<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPathologyImmunofluorescenceResult\Http\Controllers\PathologyImmunofluorescenceResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pathology-immunofluorescence-results', PathologyImmunofluorescenceResultController::class)->only(['index', 'store', 'show'])->parameters(['pathology-immunofluorescence-results' => 'pa_if_result']);
});
