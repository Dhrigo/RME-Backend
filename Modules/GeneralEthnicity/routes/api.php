<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralEthnicity\Http\Controllers\EthnicityController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ethnicities', EthnicityController::class);
});
