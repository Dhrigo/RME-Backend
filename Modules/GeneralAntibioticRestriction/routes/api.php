<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAntibioticRestriction\Http\Controllers\AntibioticRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antibiotic-restrictions', AntibioticRestrictionController::class);
});
