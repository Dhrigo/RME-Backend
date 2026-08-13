<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPhysicianRestriction\Http\Controllers\PhysicianRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('physician-restrictions', PhysicianRestrictionController::class);
});
