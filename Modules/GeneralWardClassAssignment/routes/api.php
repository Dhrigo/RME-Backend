<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardClassAssignment\Http\Controllers\GeneralWardClassAssignmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-class-assignments', GeneralWardClassAssignmentController::class)->parameters(['ward-class-assignments' => 'wardClassAssignment']);
});
