<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralMedicalDepartment\Http\Controllers\MedicalDepartmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-departments', MedicalDepartmentController::class);
});
