<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralLabServiceGroup\Http\Controllers\LabServiceGroupController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-service-groups', LabServiceGroupController::class);
});
