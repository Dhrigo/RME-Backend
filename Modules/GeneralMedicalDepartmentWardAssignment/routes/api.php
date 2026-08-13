<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralMedicalDepartmentWardAssignment\Http\Controllers\MedicalDepartmentWardAssignmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-department-ward-assignments', MedicalDepartmentWardAssignmentController::class)
        ->parameters(['medical-department-ward-assignments' => 'assignment']);
});
