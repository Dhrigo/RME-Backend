<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralExaminationGroup\Http\Controllers\ExaminationGroupController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('examination-groups', ExaminationGroupController::class);
});
