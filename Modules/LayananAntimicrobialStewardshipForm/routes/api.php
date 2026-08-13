<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipForm\Http\Controllers\AntimicrobialStewardshipFormController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-forms', AntimicrobialStewardshipFormController::class)->only(['index', 'store', 'show', 'update'])->parameters(['antimicrobial-stewardship-forms' => 'amr_form']);
});
