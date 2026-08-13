<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralFormularyRestriction\Http\Controllers\FormularyRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('formulary-restrictions', FormularyRestrictionController::class);
});
