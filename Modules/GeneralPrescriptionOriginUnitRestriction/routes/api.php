<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPrescriptionOriginUnitRestriction\Http\Controllers\PrescriptionOriginUnitRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-origin-unit-restrictions', PrescriptionOriginUnitRestrictionController::class)->parameters(['prescription-origin-unit-restrictions' => 'origin_unit_restriction']);
});
