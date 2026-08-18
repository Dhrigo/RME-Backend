<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralNurseWardAssignment\Http\Controllers\NurseWardAssignmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nurse-ward-assignments', NurseWardAssignmentController::class)->names('generalnursewardassignment.nurse-ward-assignments')->parameters(['nurse-ward-assignments' => 'nurseWardAssignment']);
});
