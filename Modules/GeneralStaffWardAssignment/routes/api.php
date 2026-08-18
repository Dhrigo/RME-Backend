<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralStaffWardAssignment\Http\Controllers\StaffWardAssignmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('staff-ward-assignments', StaffWardAssignmentController::class)->names('generalstaffwardassignment.staff-ward-assignments')->parameters(['staff-ward-assignments' => 'staffWardAssignment']);
});
