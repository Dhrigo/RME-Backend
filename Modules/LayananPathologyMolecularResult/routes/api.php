<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPathologyMolecularResult\Http\Controllers\PathologyMolecularResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pathology-molecular-results', PathologyMolecularResultController::class)->only(['index', 'store', 'show'])->parameters(['pathology-molecular-results' => 'pa_mol_result']);
});
