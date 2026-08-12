<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralOccupation\Http\Controllers\OccupationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('occupations', OccupationController::class);
});
