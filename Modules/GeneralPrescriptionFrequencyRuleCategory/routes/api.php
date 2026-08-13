<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Controllers\PrescriptionFrequencyRuleCategoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-frequency-rule-categories', PrescriptionFrequencyRuleCategoryController::class)
        ->parameters(['prescription-frequency-rule-categories' => 'freq_rule_category']);
});
