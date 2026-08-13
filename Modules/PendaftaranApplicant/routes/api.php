<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranApplicant\Http\Controllers\ApplicantController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('applicants', ApplicantController::class);
});
