<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralNurseWardAssignment\Http\Controllers\NurseWardAssignmentController;

Route::apiResource('nurse-ward-assignments', NurseWardAssignmentController::class)->names('generalnursewardassignment.nurse-ward-assignments')->parameters(['nurse-ward-assignments' => 'nurseWardAssignment']);
