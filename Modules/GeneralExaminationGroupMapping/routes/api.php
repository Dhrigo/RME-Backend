<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralExaminationGroupMapping\Http\Controllers\ExaminationGroupMappingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('examination-group-mappings', ExaminationGroupMappingController::class);
});
