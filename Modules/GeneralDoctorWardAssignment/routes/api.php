<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralDoctorWardAssignment\Http\Controllers\DoctorWardAssignmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('doctor-ward-assignments', DoctorWardAssignmentController::class)->names('generaldoctorwardassignment.doctor-ward-assignments')->parameters(['doctor-ward-assignments' => 'doctorWardAssignment']);
});
