<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPrescriptionFrequencyRule\Http\Controllers\PrescriptionFrequencyRuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-frequency-rules', PrescriptionFrequencyRuleController::class);
});
