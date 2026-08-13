<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Controllers\AntimicrobialStewardshipOtherSupportResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-other-support-results', AntimicrobialStewardshipOtherSupportResultController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-other-support-results' => 'amr_other']);
});
