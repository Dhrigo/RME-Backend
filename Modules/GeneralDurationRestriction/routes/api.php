<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralDurationRestriction\Http\Controllers\DurationRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('duration-restrictions', DurationRestrictionController::class);
});
