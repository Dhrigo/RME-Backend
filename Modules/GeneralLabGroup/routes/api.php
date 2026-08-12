<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralLabGroup\Http\Controllers\LabGroupController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-groups', LabGroupController::class);
});
